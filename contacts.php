<?php
session_start();
require_once 'db.php';
require_once 'includes/lang.php'; // подключаем словарь переводов
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
</nav>
</header>

<div class="container contacts-page">
    <h2 class="page-title"><?= $translations[$lang]['contacts'] ?></h2>
    <p class="contact-text"><?= $translations[$lang]['contact_text'] ?></p>

    <ul class="list-group contact-list">
        <li class="list-group-item contact-item"><strong>Email:</strong> mamontovconstantine@gmail.com</li>
        <li class="list-group-item contact-item"><strong><?= $translations[$lang]['phone'] ?>:</strong> +7 (777) 123-45-67</li>
        <li class="list-group-item contact-item"><strong><?= $translations[$lang]['address'] ?>:</strong> г. Усть-Каменогорск, ул. Максима Горького, 76</li>
    </ul>

    <!-- Встроенная карта -->
    <div class="mt-4">
        <h4 class="map-title"><?= $translations[$lang]['map_title'] ?></h4>
        <div style="width:100%; height:400px;">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!..." 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

    <div class="mt-4 social-block">
        <h4 class="social-title"><?= $translations[$lang]['social_title'] ?></h4>
        <a href="#" class="btn btn-outline-primary btn-sm social-link">Facebook</a>
        <a href="#" class="btn btn-outline-info btn-sm social-link">Instagram</a>
        <a href="#" class="btn btn-outline-dark btn-sm social-link">VK</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
