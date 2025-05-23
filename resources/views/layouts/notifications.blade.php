<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".mark-as-read").forEach(button => {
            button.addEventListener("click", function () {
                let notificationId = this.getAttribute("data-id");

                fetch("{{ route('notifications.markAsRead') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ id: notificationId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload the page to update notifications
                    } else {
                        toastr.error("Failed to mark notification as read.");
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });
    });
</script>
