</body>
    <script>
        const alertList = document.querySelectorAll('.alert')
        const alerts = [...alertList].map(element => new bootstrap.Alert(element))
    </script>
</html>