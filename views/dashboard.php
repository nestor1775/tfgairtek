
<?php
// Incluir el header
    include_once __DIR__ . '/templates/header.php';
?>
    <h1>login ok</h1>

    <form action="index.php?action=newProject" method="POST">
        <button type="submit">crear proyecto</button>
    </form>
    <form action="index.php?action=logout" method="POST">
        <button type="submit">Cerrar sesión</button>
    </form>

<?php
// Incluir el footer
    include_once __DIR__ . '/templates/footer.php';
?>