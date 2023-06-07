<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    </head> 
    <body>
        <script>
            $(document).ready(function(){

            alert('ni hao');

            });
        </script>
        <h1>Javascript is loading</h1>
        <input type="button" value="Say hello" onClick="showAndroidToast('Hello Android!')" />

        <script type="text/javascript">
            function showAndroidToast(toast) {
                //Android.showToast(toast);
                Android.addNotification("Working");
            }
        </script>

    </body>
</html>