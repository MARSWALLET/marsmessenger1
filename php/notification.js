document.addEventListener('DOMContentLoaded', function() {
    function checkFormsgs() {
        fetch('fetch_unread_msgs.php')
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    data.forEach(msg => {
                        displayNotification(msg);
                    });
                }
            })
            .catch(error => console.error('Error fetching msgs:', error));
    }

    function displayNotification(msg) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.innerHTML = `
            <p><strong>New msg from User ${msg.unique_id}</strong></p>
            <p>${msg.content}</p>
            <p><small>${new Date(msg.msg_at).toLocaleString()}</small></p>
        `;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 5000); // Remove notification after 5 seconds
    }

    setInterval(checkFormsgs, 5000); // Check for msgs every 5 seconds
});
