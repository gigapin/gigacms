{% extends "templates/dashboard.php" %}

{% block content %}

    <h1>Create setting</h1>

    <form action="/settings" method="post">
        <input type="text" name="name">
        <input type="submit" value="Submit">
    </form>

{% endblock %}


