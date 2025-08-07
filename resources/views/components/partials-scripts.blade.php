@if (session('success'))
    <script>
        toastMessage('Success', '{{ session('success') }}', '#ff6849', 'success');

        toastMessage = (title, text, color, icon) => {
            $.toast({
                heading: title,
                text: text,
                position: 'top-center',
                loaderBg: color,
                icon: icon,
                hideAfter: 3500,
                stack: 6
            });
        }
    </script>
    @endif @if (session('error'))
        <script>
            toastMessage('Something Went Wrong', '{{ session('error') }}', '#ff6849', 'error');

            toastMessage = (title, text, color, icon) => {
                $.toast({
                    heading: title,
                    text: text,
                    position: 'top-center',
                    loaderBg: color,
                    icon: icon,
                    hideAfter: 3500,
                    stack: 6
                });
            }
        </script>
    @endif
