<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en'
        }, 'google_translate_element');
    }

    document.addEventListener('DOMContentLoaded', function() {
        function hideGoogleTranslateToolbar() {
            // Hide the first div with class 'skiptranslate'
            var firstDivAfterBody = document.getElementsByClassName('skiptranslate')[0];
            // console.log(firstDivAfterBody);
            if (firstDivAfterBody) {
                firstDivAfterBody.style.display = 'none';
            }

            // Ensure the dropdown within #google_translate_element is visible
            var googleTranslateDropdown = document.querySelector('#google_translate_element .skiptranslate');
            if (googleTranslateDropdown) {
                googleTranslateDropdown.style.display = 'block';
            }
        }

        // Run the function immediately after the page loads
        setTimeout(hideGoogleTranslateToolbar, 2000);

        // Run the function every 5 seconds
        setInterval(hideGoogleTranslateToolbar, 5000);
    });
</script>


<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>