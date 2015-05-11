<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap/css/clndr.css">
</head>
<body>
<div class="container">
    <div class="cal1">
    </div>
    <div class="cal2">

        <script type="text/template" id="template-calendar">
            <div class="clndr-controls">
                <div class="clndr-previous-button">&lsaquo;</div>
                <div class="month"><%= month %></div>
                <div class="clndr-next-button">&rsaquo;</div>
            </div>
            <div class="clndr-grid">
                <div class="days-of-the-week">
                    <% _.each(daysOfTheWeek, function(day) { %>
                    <div class="header-day"><%= day %></div>
                    <% }); %>
                    <div class="days">
                        <% _.each(days, function(day) { %>
                        <div class="<%= day.classes %>"><%= day.day %></div>
                        <% }); %>
                    </div>
                </div>
            </div>
            <div class="clndr-today-button">Today</div>
        </script>

    </div>
</div>


<script src="bootstrap/js/json2.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<script src= "bootstrap/js/moment-2.8.3.js"></script>

<script src="bootstrap/js/clndr.js"></script>
<script src="bootstrap/js/site.js"></script>

<!-- Enable live-reloading in the browser without an extension -->
<script src="http://localhost:35729/livereload.js"></script>
</body>
</html>