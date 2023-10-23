document.addEventListener("DOMContentLoaded", function() {
    var rows = document.querySelectorAll('table tr[data-room-id]');
    rows.forEach(row => {
        row.addEventListener('click', function() {
            var roomId = this.dataset.roomId;
            window.location.href = 'details.php?roomID=' + roomId;
        });
    });
});