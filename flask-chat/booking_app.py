import eventlet

eventlet.monkey_patch()  # Важно: должен быть самым первым импортом

from flask import Flask, request
from flask_socketio import SocketIO, emit
from datetime import datetime, timedelta
import json

app = Flask(__name__)
app.config['SECRET_KEY'] = 'your_secret_key_here'
socketio = SocketIO(app, cors_allowed_origins="*", async_mode='eventlet')

# Конфигурация бронирования
TIME_SLOTS = [f"{h}:00" for h in range(10, 18)]  # С 10:00 до 17:00
MAX_BOOKINGS_PER_SLOT = 5  # Максимальное количество броней на один слот
BOOKING_DAYS_AHEAD = 5  # Количество дней для бронирования

# Хранилище броней (в продакшене используйте БД)
bookings = {}


def generate_time_slots():
    """Генерирует слоты на указанное количество дней вперед"""
    slots = {}
    for day in range(BOOKING_DAYS_AHEAD):
        date = (datetime.now() + timedelta(days=day)).strftime('%Y-%m-%d')
        slots[date] = {slot: [] for slot in TIME_SLOTS}
    return slots


# Инициализация хранилища
bookings = generate_time_slots()


@socketio.on('connect')
def handle_connect():
    """Обработчик подключения нового клиента"""
    emit('slots_update', bookings)


@socketio.on('book_slot')
def handle_booking(data):
    """Обработчик запроса на бронирование"""
    try:
        date = data['date']
        slot = data['slot']
        user_id = data['user_id']
        user_name = data['user_name']

        # Проверяем доступность слота
        if date not in bookings or slot not in bookings[date]:
            emit('booking_error', {'message': 'Invalid time slot'})
            return

        if len(bookings[date][slot]) >= MAX_BOOKINGS_PER_SLOT:
            emit('booking_error', {
                'message': f'Это время уже забронировано максимальным количеством людей ({MAX_BOOKINGS_PER_SLOT})'
            })
            return

        # Проверяем, не забронировал ли уже этот пользователь данный слот
        if any(booking['user_id'] == user_id for booking in bookings[date][slot]):
            emit('booking_error', {
                'message': 'Вы уже забронировали это время'
            })
            return

        # Добавляем бронь
        new_booking = {
            'user_id': user_id,
            'user_name': user_name,
            'booked_at': datetime.now().isoformat()
        }
        bookings[date][slot].append(new_booking)

        # Отправляем подтверждение
        emit('booking_success', {
            'date': date,
            'slot': slot,
            'user_name': user_name,
            'current_count': len(bookings[date][slot]),
            'max_count': MAX_BOOKINGS_PER_SLOT
        }, room=request.sid)

        # Обновляем всех клиентов
        emit('slots_update', bookings, broadcast=True)

    except Exception as e:
        emit('booking_error', {
            'message': f'Произошла ошибка: {str(e)}'
        })


@socketio.on('cancel_booking')
def handle_cancel_booking(data):
    """Обработчик отмены бронирования"""
    try:
        date = data['date']
        slot = data['slot']
        user_id = data['user_id']

        if date not in bookings or slot not in bookings[date]:
            emit('cancel_error', {'message': 'Invalid time slot'})
            return

        # Удаляем бронь пользователя
        bookings[date][slot] = [b for b in bookings[date][slot] if b['user_id'] != user_id]

        emit('cancel_success', {
            'date': date,
            'slot': slot,
            'user_id': user_id
        }, room=request.sid)

        # Обновляем всех клиентов
        emit('slots_update', bookings, broadcast=True)

    except Exception as e:
        emit('cancel_error', {
            'message': f'Произошла ошибка: {str(e)}'
        })


if __name__ == '__main__':
    print("🚀 Система бронирования запущена на http://localhost:5000")
    socketio.run(app, host='0.0.0.0', port=5000, debug=True)