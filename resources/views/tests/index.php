{% extends "templates/basewind.html" %}

{% block content %}
<div class="bg-indigo-300">
    <button>Save</button>
    <button>Update</button>
</div>
<div class="lg:grid lg:grid-cols-3 lg:gap-2 lg:grid-rows-3 2xl:flex">
    <div class="flex jusitfy-around lg:hidden">
        <div class="w-1/2 text-center">
            <button onclick="sxFunc()">SX</button> 
        </div>
        <div class="w-1/2 text-center">
            <a href="" class="">DX</a>
        </div>
    </div>
    <div class="bg-red-500 hidden lg:block lg:row-start-2 lg:row-span-2 xl:w-72 2xl:w-80 2xl:flex-grow" id="first-box">
        <p>dsffsdfsd</p>
        <ul>
            <li>sfsf</li>
            <li>sfsf</li>
            <li>sfsf</li>
            <li>sfsf</li>
        </ul>
        <p>dsffsdfsd</p>
        <p>dsffsdfsd</p>
        <ul>
            <li>sfsf</li>
            <li>sfsf</li>
            <li>sfsf</li>
            <li>sfsf</li>
        </ul>
        <p>dsffsdfsd</p>
        <p>dsffsdfsd</p>
        <ul>
            <li>sfsf</li>
            <li>sfsf</li>
            <li>sfsf</li>
            <li>sfsf</li>
        </ul>
        <p>dsffsdfsd</p>
        
    </div>

    <div class="bg-blue-500 2xl:flex-none lg:cols-span-2 lg:col-start-2 lg:col-end-4 lg:row-span-3" id="main-box">
        <p>etwertd</p>
        <p>fsddf</p>
        <ul class="py-12">
            <li>asdasds</li>
            <li>adsdas</li>
            <li>adasdasd</li>
            <li>asdsdas</li>
            <li>adasdasd</li>
        </ul>
        <ul class="py-12">
            <li>asdasds</li>
            <li>adsdas</li>
            <li>adasdasd</li>
            <li>asdsdas</li>
            <li>adasdasd</li>
        </ul>
        <ul class="py-12">
            <li>asdasds</li>
            <li>adsdas</li>
            <li>adasdasd</li>
            <li>asdsdas</li>
            <li>adasdasd</li>
        </ul>
    </div>

    <div class="bg-yellow-500 hidden  lg:block lg:row-start-1 lg:row-end-1 xl:w-72 2xl:w-80 2xl:flex-grow ">
        <a href="">sdfsd</a>
        <p>dgdxgfdfdsffff s rd re rtrtrtrt</p>
        <button class="p-4 bg-green-600">ffsddg</button>
    </div>

</div>

<script>
    function sxFunc() {
        document.getElementById('first-box').classList.toggle('hidden');
        document.getElementById('main-box').classList.toggle('hidden');
    }

</script>

{% endblock %}
