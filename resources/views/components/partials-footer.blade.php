<footer class="footer shadow"> © {{ date('Y') }} <a href="{{ route('index') }}" target="_blank">{{ setting()->brand_name }}</a></footer>
<script>
    function livechatPopup() {
        newwindow = window.open('https://secure.livechatinc.com/licence/{{ setting()->livechat }}/v2/open_chat.cgi?license=11937489&amp;group=0&amp;embedded=1&amp;widget_version=3&amp;unique_groups=0', 'name', 'height=500,width=400,right=0px, bottom=0 , menubar=no, toolbar=no, location=no, directories=no, status=no, scrollbars=no, resizable=no, dependent, screenX=1500, screenY=480 ');
        if (window.focus) {
            newwindow.focus()
        }
        return false;
    }

</script>
