<?php include_once('utils/log_out.php') ?>

<header>
    <nav>
        <ul class="menu-list">
            <li><a href="list.php?type=students">Students</a></li>
            <li><a href="list.php?type=courses">Courses</a></li>
            <li><a href="list.php?type=teachers">Teachers</a></li>
        </ul>

        <button onclick="toggleTheme()" id="toggler" class="normal-button">Dark Mode</button>

        <button class="normal-button">
            <a href="?logout=true">Log out</a>
        </button>
    </nav>
</header>