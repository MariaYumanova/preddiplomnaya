<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Опрос: какие технологии вам интересны? — Student IT Community</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <!-- Шапка сайта -->
    <header class="site-header">
        <div class="container">
            <div class="header-inner">
                <div class="site-branding">
                    <p class="site-title"><a href="/" rel="home">Student IT Community</a></p>
                </div>

                <nav class="main-nav">
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><a href="/news/">Новости</a></li>
                        <li><a href="/shop/">Магазин</a></li>
                        <li><a href="/a5213-contact/">Контакты</a></li>
                        <li><a href="/%d0%be-%d1%81%d0%be%d0%be%d0%b1%d1%89%d0%b5%d1%81%d1%82%d0%b2%d0%b5/">О сообществе</a></li>
                        <li><a href="/my-account/">Мой аккаунт</a></li>
                        <li><a href="/cart/">Корзина</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Основной контент -->
    <main class="container">
        <div class="main-content">
            <article>
                <header>
                    <h1 class="page-title">Опрос: какие технологии вам интересны?</h1>
                    <div class="entry-meta">
                        <span class="byline">От <a class="url fn n" href="/author/admin/">admin</a></span>
                        <span class="posted-on"><a href="/%d0%be%d0%bf%d1%80%d0%be%d1%81-%d0%ba%d0%b0%d0%ba%d0%b8%d0%b5-%d1%82%d0%b5%d1%85%d0%bd%d0%be%d0%bb%d0%be%d0%b3%d0%b8%d0%b8-%d0%b2%d0%b0%d0%bc-%d0%b8%d0%bd%d1%82%d0%b5%d1%80%d0%b5%d1%81%d0%bd%d1%8b/" rel="bookmark">17.07.2019</a></span>
                        <span class="cat-links"><a href="/category/uncategorized/" rel="category tag">Uncategorized</a></span>
                    </div>
                </header>

                <div class="entry-content">
                    <div class="poll-container">
                        <h2 class="poll-title">Какие технологии вам интересны?</h2>

                        <div class="poll-options">
                            <div class="poll-option">
                                <input type="radio" id="dish1" name="dish" value="Blockchain (Solidity, Web3)">
                                <label for="dish1">Blockchain (Solidity, Web3)</label>
                            </div>

                            <div class="poll-option">
                                <input type="radio" id="dish2" name="dish" value="Квантовые вычисления">
                                <label for="dish2">Квантовые вычисления</label>
                            </div>

                            <div class="poll-option">
                                <input type="radio" id="dish3" name="dish" value="DevOps (Docker, Kubernetes)">
                                <label for="dish3">DevOps (Docker, Kubernetes)</label>
                            </div>

                            <div class="poll-option">
                                <input type="radio" id="dish4" name="dish" value="Компьютерное зрение">
                                <label for="dish4">Компьютерное зрение</label>
                            </div>
                        </div>

                        <div class="poll-actions">
                            <button id="vote-btn" class="btn-vote">Голосовать</button>
                            <button id="results-btn" class="btn-results">Посмотреть результаты</button>
                        </div>

                        <div id="poll-results" class="poll-results">
                            <h3>Результаты опроса:</h3>
                            <div class="result-chart">
                                <div class="dish-name">Blockchain (Solidity, Web3)</div>
                                <div class="result-bar" data-dish="Blockchain (Solidity, Web3)" style="width: 0%;">
                                    <span class="dish-percent">0%</span>
                                    <span class="dish-votes">(0 голосов)</span>
                                </div>

                                <div class="dish-name">Квантовые вычисления</div>
                                <div class="result-bar" data-dish="Квантовые вычисления" style="width: 0%;">
                                    <span class="dish-percent">0%</span>
                                    <span class="dish-votes">(0 голосов)</span>
                                </div>

                                <div class="dish-name">DevOps (Docker, Kubernetes)</div>
                                <div class="result-bar" data-dish="DevOps (Docker, Kubernetes)" style="width: 0%;">
                                    <span class="dish-percent">0%</span>
                                    <span class="dish-votes">(0 голосов)</span>
                                </div>

                                <div class="dish-name">Компьютерное зрение</div>
                                <div class="result-bar" data-dish="Компьютерное зрение" style="width: 0%;">
                                    <span class="dish-percent">0%</span>
                                    <span class="dish-votes">(0 голосов)</span>
                                </div>
                            </div>
                            <div class="total-votes">Всего голосов: <span id="total-votes">0</span></div>
                        </div>

                        <div id="poll-message" class="poll-message"></div>
                    </div>
                </div>
            </article>
        </div>

        <!-- Боковая панель -->
        <aside class="sidebar">
            <div class="widget">
                <form role="search" method="get" class="search-form" action="/">
                    <label>
                        <span class="screen-reader-text">Найти:</span>
                        <input type="search" class="search-field" placeholder="Поиск…" value="" name="s">
                    </label>
                    <input type="submit" class="search-submit" value="Поиск">
                </form>
            </div>

            <div class="widget">
                <h3 class="widget-title">Свежие записи</h3>
                <ul class="widget-list">
                    <li><a href="/%d0%b8%d1%82%d0%be%d0%b3%d0%b8-%d1%87%d0%b5%d0%bc%d0%bf%d0%b8%d0%be%d0%bd%d0%b0%d1%82%d0%b0-%d0%bf%d0%be-%d0%b0%d0%bb%d0%b3%d0%be%d1%80%d0%b8%d1%82%d0%bc%d0%b0%d0%bc-%d0%b2%d0%b8%d1%82%d1%82/">Итоги чемпионата по алгоритмам «Витте.Code»</a></li>
                    <li><a href="/%d0%bd%d0%be%d0%b2%d0%b0%d1%8f-%d0%bb%d0%b0%d0%b1%d0%be%d1%80%d0%b0%d1%82%d0%be%d1%80%d0%b8%d1%8f-vr-ar-%d0%be%d1%82%d0%ba%d1%80%d1%8b%d1%82%d0%b0-%d0%b2-%d0%ba%d0%b0%d0%bc%d0%bf%d1%83%d1%81%d0%b5/">Новая лаборатория VR/AR открыта в кампусе</a></li>
                    <li><a href="/%d0%be%d0%bf%d1%80%d0%be%d1%81-%d0%ba%d0%b0%d0%ba%d0%b8%d0%b5-%d1%82%d0%b5%d1%85%d0%bd%d0%be%d0%bb%d0%be%d0%b3%d0%b8%d0%b8-%d0%b2%d0%b0%d0%bc-%d0%b8%d0%bd%d1%82%d0%b5%d1%80%d0%b5%d1%81%d0%bd%d1%8b/" aria-current="page">Опрос: какие технологии вам интересны?</a></li>
                </ul>
            </div>

            <div class="widget">
                <h3 class="widget-title">Архивы</h3>
                <ul class="widget-list">
                    <li><a href="/2025/01/">Январь 2025</a></li>
                    <li><a href="/2019/07/">Июль 2019</a></li>
                </ul>
            </div>
        </aside>
    </main>

    <!-- Подвал сайта -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3 class="footer-title">О нас!</h3>
                    <ul class="footer-links">
                        <li><a href="/a5213-contact/">Контакты</a></li>
                        <li><a href="#">Версия сайта для слабовидящих</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3 class="footer-title">Последние новости</h3>
                    <ul class="footer-links">
                        <li><a href="/%d0%b8%d1%82%d0%be%d0%b3%d0%b8-%d1%87%d0%b5%d0%bc%d0%bf%d0%b8%d0%be%d0%bd%d0%b0%d1%82%d0%b0-%d0%bf%d0%be-%d0%b0%d0%bb%d0%b3%d0%be%d1%80%d0%b8%d1%82%d0%bc%d0%b0%d0%bc-%d0%b2%d0%b8%d1%82%d1%82/">Итоги чемпионата по алгоритмам «Витте.Code»</a></li>
                        <li><a href="/%d0%bd%d0%be%d0%b2%d0%b0%d1%8f-%d0%bb%d0%b0%d0%b1%d0%be%d1%80%d0%b0%d1%82%d0%be%d1%80%d0%b8%d1%8f-vr-ar-%d0%be%d1%82%d0%ba%d1%80%d1%8b%d1%82%d0%b0-%d0%b2-%d0%ba%d0%b0%d0%bc%d0%bf%d1%83%d1%81%d0%b5/">Новая лаборатория VR/AR открыта в кампусе</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3 class="footer-title">Свежие записи</h3>
                    <ul class="footer-links">
                        <li><a href="/%d0%b8%d1%82%d0%be%d0%b3%d0%b8-%d1%87%d0%b9%d0%bc%d0%bf%d0%b8%d0%be%d0%bd%d0%b0%d1%82%d0%b0-%d0%bf%d0%be-%d0%b0%d0%bb%d0%b3%d0%be%d1%80%d0%b8%d1%82%d0%bc%d0%b0%d0%bc-%d0%b2%d0%b8%d1%82%d1%82/">Итоги чемпионата по алгоритмам «Витте.Code»</a></li>
                    </ul>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; 2025 Student IT Community Юманова Мария Андреевна.</p>
            </div>
        </div>
    </footer>

		<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Опрос загружен - отладка включена');

        // Хранилище голосов
        let pollResults = {
            "Blockchain (Solidity, Web3)": 0,
            "Квантовые вычисления": 0,
            "DevOps (Docker, Kubernetes)": 0,
            "Компьютерное зрение": 0
        };

        // Проверяем, есть ли сохраненные результаты в localStorage
        if (localStorage.getItem('dishPollResults')) {
            try {
                pollResults = JSON.parse(localStorage.getItem('dishPollResults'));
                console.log('Результаты загружены:', pollResults);
            } catch (e) {
                console.error('Ошибка загрузки результатов:', e);
            }
        }

        const voteBtn = document.getElementById('vote-btn');
        const resultsBtn = document.getElementById('results-btn');
        const pollResultsDiv = document.getElementById('poll-results');
        const messageDiv = document.getElementById('poll-message');



        // Обработчик голосования
        voteBtn.addEventListener('click', function() {
            console.log('Нажата кнопка голосования');

            const selectedDish = document.querySelector('input[name="dish"]:checked');
            console.log('Выбранный вариант:', selectedDish ? selectedDish.value : 'не выбрано');

            if (!selectedDish) {
                showMessage('Пожалуйста, выберите вариант!', 'error');
                return;
            }

            // Проверяем, голосовал ли уже пользователь
            const hasVoted = localStorage.getItem('hasVoted');
            console.log('hasVoted значение:', hasVoted);

            if (hasVoted === 'true') {
                showMessage('Вы уже проголосовали!', 'error');
                return;
            }

            // Увеличиваем счетчик голосов
            pollResults[selectedDish.value]++;
            console.log('Новые результаты:', pollResults);

            // Сохраняем результаты
            localStorage.setItem('dishPollResults', JSON.stringify(pollResults));
            localStorage.setItem('hasVoted', 'true');

            showMessage('Спасибо за ваш голос!', 'success');
            updateResults();
        });

        // Обработчик просмотра результатов
        resultsBtn.addEventListener('click', function() {
            console.log('Показать результаты');
            updateResults();
            pollResultsDiv.style.display = 'block';
        });

        // Функция обновления результатов
        function updateResults() {
    const totalVotes = Object.values(pollResults).reduce((a, b) => a + b, 0);
    console.log('Всего голосов:', totalVotes);

    document.getElementById('total-votes').textContent = totalVotes;

    if (totalVotes === 0) {
        console.log('Нет голосов');
        // Сбрасываем все полоски к 0%
        document.querySelectorAll('.result-bar').forEach(bar => {
            bar.style.width = '0%';
            bar.querySelector('.dish-percent').textContent = '0%';
            bar.querySelector('.dish-votes').textContent = '(0 голосов)';
        });
        return;
    }

    // Обновляем проценты
    for (const dish in pollResults) {
        const votes = pollResults[dish];
        const percent = Math.round((votes / totalVotes) * 100);

        const bar = document.querySelector(`.result-bar[data-dish="${dish}"]`);
        if (bar) {
            bar.style.width = `${percent}%`;
            bar.querySelector('.dish-percent').textContent = `${percent}%`;
            bar.querySelector('.dish-votes').textContent = `(${votes} голосов)`;

            console.log(`Вариант: ${dish}, Голосов: ${votes}, Процент: ${percent}%`);
        }
    }
}

        // Функция показа сообщений
        function showMessage(text, type) {
            console.log('Сообщение:', text, type);
            messageDiv.textContent = text;
            messageDiv.className = type + '-message';
            messageDiv.style.display = 'block';

            setTimeout(function() {
                messageDiv.style.display = 'none';
            }, 3000);
        }

        // Инициализация при загрузке
        updateResults();

        // Проверяем состояние голосования
        console.log('Состояние голосования:', localStorage.getItem('hasVoted'));
    });
    </script>
</body>
</html>
