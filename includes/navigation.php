<?php require_once 'lang.php'; ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><?= $translations[$lang]['home'] ?></a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="index.php"><?= $translations[$lang]['home'] ?></a></li>
      <li class="nav-item"><a class="nav-link" href="contacts.php"><?= $translations[$lang]['contacts'] ?></a></li>
      <li class="nav-item"><a class="nav-link" href="ai_assistant.php"><?= $translations[$lang]['assistant'] ?></a></li>
      <li class="nav-item"><a class="nav-link" href="cabinet.php"><?= $translations[$lang]['profile'] ?></a></li>
      <li class="nav-item"><a class="nav-link" href="login.php"><?= $translations[$lang]['login'] ?></a></li>
    </ul>

    <!-- Переключатель языков -->
    <form method="get" class="form-inline me-3">
      <label for="lang" class="me-2"><?= $translations[$lang]['language'] ?>:</label>
      <select name="lang" id="lang" class="form-select" onchange="this.form.submit()">
        <option value="ru" <?= $lang==='ru'?'selected':'' ?>>RU</option>
        <option value="en" <?= $lang==='en'?'selected':'' ?>>EN</option>
        <option value="kz" <?= $lang==='kz'?'selected':'' ?>>KZ</option>
      </select>
    </form>

    <!-- Кнопка "Назад" -->
    <button class="btn btn-outline-secondary" onclick="window.history.back();">
      <?= $translations[$lang]['back'] ?? 'Назад' ?>
    </button>
  </div>
</nav>
