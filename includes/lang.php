<?php
session_start();

// Установка языка через GET-параметр
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'ru';

// Общие переводы
$translations = [
    'ru' => [
        // Навигация
        'back' => 'Назад',
        'home' => 'Главная',
        'assistant' => 'AI-ассистент',
        'profile' => 'Профиль',
        'contacts' => 'Контакты',
        'language' => 'Язык',
        'login' => 'Вход',
        'logout' => 'Выход',

        // Кнопки
        'add' => 'Добавить',
        'delete' => 'Удалить',
        'edit' => 'Редактировать',

        // Главная
        'welcome_title' => 'Добро пожаловать на наш сайт!',
        'welcome_text' => 'Здесь вы можете пройти психологические тесты, получить рекомендации и изучить полезные курсы.',
        'login_register' => 'Войти или зарегистрироваться',
        'go_to_cabinet' => 'Перейти в личный кабинет',

        // Контакты
        'contact_text' => 'Если у вас есть вопросы или предложения, свяжитесь с нами:',
        'phone' => 'Телефон',
        'address' => 'Адрес',
        'map_title' => 'Мы на карте:',
        'social_title' => 'Мы в социальных сетях:',
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'vk' => 'ВКонтакте',

        // Авторизация
        'auth_title' => 'Авторизация / Регистрация',
        'username' => 'Имя пользователя',
        'password' => 'Пароль',
        'email' => 'Email',
        'role' => 'Выберите роль',
        'role_user' => 'Пользователь',
        'role_psychologist' => 'Психолог',
        'role_admin' => 'Администратор',
        'action' => 'Выберите действие:',
        'action_login' => 'Войти',
        'action_register' => 'Зарегистрироваться',
        'continue' => 'Продолжить',

        // Ошибки
        'error_fill_fields' => 'Заполните все поля.',
        'error_invalid_login' => 'Неверное имя пользователя или пароль.',
        'error_short_password' => 'Пароль должен быть не менее 6 символов.',
        'error_invalid_email' => 'Некорректный email.',
        'error_user_exists' => 'Пользователь с таким именем уже существует.',
        'error_general' => 'Ошибка:',

        // Тесты
        'choose_test' => 'Выбор теста',
        'test_burnout' => 'Тест на выгорание',
        'test_stress' => 'Тест на стресс',
        'test_emotional' => 'Тест на эмоциональное состояние',
        'test_anxiety' => 'Тест на тревожность',
        'test_motivation' => 'Тест на мотивацию',
        'start' => 'Начать',
        'yes' => 'Да',
        'no' => 'Нет',
        'finish_test' => 'Завершить тест',
        'description' => 'Описание',
        'recommendations' => 'Рекомендации',
        'result_low' => 'Ваш результат: низкий уровень.',
        'desc_normal' => 'Состояние в пределах нормы.',
        'rec_balance' => 'Продолжайте поддерживать баланс работы и отдыха.',
        'result_medium' => 'Ваш результат: средний уровень.',
        'desc_tension' => 'Есть признаки напряжения.',
        'rec_rest' => 'Рекомендуется уделять больше внимания отдыху и самоподдержке.',
        'result_high' => 'Ваш результат: высокий уровень.',
        'desc_high_tension' => 'Вы испытываете значительное напряжение.',
        'rec_specialist' => 'Рекомендуется обратиться к специалисту и снизить нагрузку.',
        'test_results' => 'Результаты тестов',
        'select_placeholder' => '-- выбрать --',
        'no_data' => 'В таблице нет данных для отображения.',

        // Курсы
        'available_courses' => 'Доступные курсы',
        'no_courses' => 'Курсы пока не добавлены.',
        'add_course_title' => 'Добавить новый курс',
        'course_name' => 'Название курса',
        'course_added' => 'Курс успешно добавлен.',
        'course_add_error' => 'Ошибка при добавлении курса:',
        'enter_course_name' => 'Введите название курса.',
        'no_permission' => 'У вас нет прав для добавления курсов.',

        // Рекомендации
        'your_recommendations' => 'Ваши рекомендации',
        'from_user' => 'От кого',
        'recommendation' => 'Рекомендация',
        'no_recommendations' => 'Для вас пока нет рекомендаций.',

        // Админ‑панель
        'admin_panel' => 'Админ‑панель',
        'table' => 'Таблица',
        'actions' => 'Действия',
        'confirm_delete' => 'Удалить запись?',
        'add_record' => 'Добавить запись'
    ],

    'en' => [
        'home' => 'Home',
        'assistant' => 'AI Assistant',
        'profile' => 'Profile',
        'contacts' => 'Contacts',
        'language' => 'Language',
        'login' => 'Login',
        'logout' => 'Logout',

        'add' => 'Add',
        'delete' => 'Delete',
        'edit' => 'Edit',

        'welcome_title' => 'Welcome to our website!',
        'welcome_text' => 'Here you can take psychological tests, get recommendations, and study useful courses.',
        'login_register' => 'Login or Register',
        'go_to_cabinet' => 'Go to Personal Cabinet',

        'contact_text' => 'If you have any questions or suggestions, contact us:',
        'phone' => 'Phone',
        'address' => 'Address',
        'map_title' => 'Find us on the map:',
        'social_title' => 'We are on social media:',
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'vk' => 'VK',

        'auth_title' => 'Login / Registration',
        'username' => 'Username',
        'password' => 'Password',
        'email' => 'Email',
        'role' => 'Select role',
        'role_user' => 'User',
        'role_psychologist' => 'Psychologist',
        'role_admin' => 'Administrator',
        'action' => 'Select action:',
        'action_login' => 'Login',
        'action_register' => 'Register',
        'continue' => 'Continue',

        'error_fill_fields' => 'Please fill in all fields.',
        'error_invalid_login' => 'Invalid username or password.',
        'error_short_password' => 'Password must be at least 6 characters.',
        'error_invalid_email' => 'Invalid email.',
        'error_user_exists' => 'User with this name already exists.',
        'error_general' => 'Error:',

        'choose_test' => 'Choose a test',
        'test_burnout' => 'Burnout Test',
        'test_stress' => 'Stress Test',
        'test_emotional' => 'Emotional State Test',
        'test_anxiety' => 'Anxiety Test',
        'test_motivation' => 'Motivation Test',
        'start' => 'Start',
        'yes' => 'Yes',
        'no' => 'No',
        'finish_test' => 'Finish Test',
        'description' => 'Description',
        'recommendations' => 'Recommendations',
        'result_low' => 'Your result: low level.',
        'desc_normal' => 'Condition within normal limits.',
        'rec_balance' => 'Keep maintaining work-life balance.',
        'result_medium' => 'Your result: medium level.',
        'desc_tension' => 'Signs of tension present.',
        'rec_rest' => 'It is recommended to pay more attention to rest and self-care.',
        'result_high' => 'Your result: high level.',
        'desc_high_tension' => 'You are experiencing significant tension.',
        'rec_specialist' => 'It is recommended to consult a specialist and reduce workload.',
        'test_results' => 'Test Results',
        'select_placeholder' => '-- select --',
        'no_data' => 'No data available in the table.',

        'available_courses' => 'Available Courses',
        'no_courses' => 'No courses have been added yet.',
        'add_course_title' => 'Add New Course',
        'course_name' => 'Course Name',
        'course_added' => 'Course added successfully.',
        'course_add_error' => 'Error adding course:',
        'enter_course_name' => 'Please enter the course name.',
        'no_permission' => 'You do not have permission to add courses.',

        'your_recommendations' => 'Your Recommendations',
        'from_user' => 'From',
        'recommendation' => 'Recommendation',
        'no_recommendations' => 'No recommendations for you yet.',

        'admin_panel' => 'Admin Panel',
        'table' => 'Table',
        'actions' => 'Actions',
        'confirm_delete' => 'Delete record?',
        'add_record' => 'Add record'
    ],

    'kz' => [
    // Навигация
    'home' => 'Басты бет',
    'assistant' => 'AI көмекші',
    'profile' => 'Профиль',
    'contacts' => 'Байланыс',
    'language' => 'Тіл',
    'back' => 'Артқа',
    'login' => 'Кіру',
    'logout' => 'Шығу',

    // Кнопки
    'add' => 'Қосу',
    'delete' => 'Жою',
    'edit' => 'Өңдеу',

    // Главная
    'welcome_title' => 'Біздің сайтқа қош келдіңіз!',
    'welcome_text' => 'Мұнда сіз психологиялық тесттерден өтіп, ұсыныстар алып, пайдалы курстарды оқи аласыз.',
    'login_register' => 'Кіру немесе тіркелу',
    'go_to_cabinet' => 'Жеке кабинетке өту',

    // Контакты
    'contact_text' => 'Сұрақтарыңыз немесе ұсыныстарыңыз болса, бізге хабарласыңыз:',
    'phone' => 'Телефон',
    'address' => 'Мекенжай',
    'map_title' => 'Картадан табыңыз:',
    'social_title' => 'Әлеуметтік желілерде біз:',
    'facebook' => 'Facebook',
    'instagram' => 'Instagram',
    'vk' => 'ВКонтакте',

    // Авторизация
    'auth_title' => 'Авторизация / Тіркелу',
    'username' => 'Пайдаланушы аты',
    'password' => 'Құпиясөз',
    'email' => 'Email',
    'role' => 'Рөлді таңдаңыз',
    'role_user' => 'Пайдаланушы',
    'role_psychologist' => 'Психолог',
    'role_admin' => 'Әкімші',
    'action' => 'Әрекетті таңдаңыз:',
    'action_login' => 'Кіру',
    'action_register' => 'Тіркелу',
    'continue' => 'Жалғастыру',

    // Ошибки
    'error_fill_fields' => 'Барлық өрістерді толтырыңыз.',
    'error_invalid_login' => 'Қате пайдаланушы аты немесе құпиясөз.',
    'error_short_password' => 'Құпиясөз кемінде 6 таңбадан тұруы керек.',
    'error_invalid_email' => 'Қате email.',
    'error_user_exists' => 'Бұл атпен пайдаланушы бұрыннан бар.',
    'error_general' => 'Қате:',

    // Тесты
    'choose_test' => 'Тестті таңдау',
    'test_burnout' => 'Шаршау тесті',
    'test_stress' => 'Стресс тесті',
    'test_emotional' => 'Эмоциялық күй тесті',
    'test_anxiety' => 'Алаңдаушылық тесті',
    'test_motivation' => 'Мотивация тесті',
    'start' => 'Бастау',
    'yes' => 'Иә',
    'no' => 'Жоқ',
    'finish_test' => 'Тестті аяқтау',
    'description' => 'Сипаттама',
    'recommendations' => 'Ұсыныстар',
    'result_low' => 'Нәтиже: төмен деңгей.',
    'desc_normal' => 'Жағдай қалыпты.',
    'rec_balance' => 'Жұмыс пен демалыс арасындағы тепе-теңдікті сақтаңыз.',
    'result_medium' => 'Нәтиже: орташа деңгей.',
    'desc_tension' => 'Кернеу белгілері бар.',
    'rec_rest' => 'Демалыс пен өзін-өзі қолдауға көбірек көңіл бөлу ұсынылады.',
    'result_high' => 'Нәтиже: жоғары деңгей.',
    'desc_high_tension' => 'Сіз айтарлықтай кернеу сезінудесіз.',
    'rec_specialist' => 'Маманға жүгіну және жүктемені азайту ұсынылады.',
    'test_results' => 'Тест нәтижелері',
    'select_placeholder' => '-- таңдау --',
    'no_data' => 'Кестеде көрсетілетін деректер жоқ.',

    // Курсы
    'available_courses' => 'Қолжетімді курстар',
    'no_courses' => 'Курстар әлі қосылған жоқ.',
    'add_course_title' => 'Жаңа курс қосу',
    'course_name' => 'Курс атауы',
    'course_added' => 'Курс сәтті қосылды.',
    'course_add_error' => 'Курс қосу қатесі:',
    'enter_course_name' => 'Курс атауын енгізіңіз.',
    'no_permission' => 'Курс қосуға құқығыңыз жоқ.',

    // Рекомендации
    'your_recommendations' => 'Сіздің ұсыныстарыңыз',
    'from_user' => 'Кімнен',
    'recommendation' => 'Ұсыныс',
    'no_recommendations' => 'Әзірге сізге ұсыныстар жоқ.',

    // Админ‑панель
    'admin_panel' => 'Әкімші панелі',
    'table' => 'Кесте',
    'actions' => 'Әрекеттер',
    'confirm_delete' => 'Жазбаны жою?',
    'add_record' => 'Жазба қосу'
]];