<!doctype html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <!-- AJAX n jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
    <form id="loginform" method="post">
        <div>
            titulo:
            <input type="text" name="title" id="title" />
            body:
            <input type="text" name="body" id="body" />
            author:
            <input type="text" name="author" id="author" />
            <input type="submit" name="submit" id="submit" value="Login" />
        </div>
    </form>
    <script>
        $(document).ready(function() {

            $("#submit").click(function() {


                var title = $("#title").val();
                var body = $("#body").val();
                var author = $("#author").val();

                if (title == '' || body == '' || author == '') {
                    alert("Please fill all fields.");
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: "insert.php",
                    data: {
                        title: title,
                        body: body,
                        author: author
                    },
                    cache: false,
                    success: function(data) {   
                        alert('inserted');
                        alert(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });

            });

        });
    </script>
</body>

</html>