import eventlet
eventlet.monkey_patch()

from flask import Flask
from flask_socketio import SocketIO, emit
from datetime import datetime

app = Flask(__name__)
app.config['SECRET_KEY'] = 'ваш_уникальный_ключ'  # Замените на свой!

socketio = SocketIO(app, cors_allowed_origins="*")

messages = []

@socketio.on('connect')
def handle_connect():
    emit('message_history', {'messages': messages})

@socketio.on('send_message')
def handle_message(data):
    message = {
        'text': data['text'],
        'sender': data['sender_name'],
        'time': datetime.now().strftime("%H:%M"),
        'user_id': data['user_id']
    }
    messages.append(message)
    emit('new_message', message, broadcast=True)

if __name__ == '__main__':
    print('🚀 Сервер запущен: http://localhost:5000')
    socketio.run(app, host='0.0.0.0', port=5000, debug=True)