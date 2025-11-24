<nav class="bg-white shadow p-4">
    <div class="max-w-7xl mx-auto flex justify-between">
        <h1 class="font-bold text-lg">Inventory App</h1>

        <form action="/logout" method="POST">
            @csrf
            <button class="text-red-500">Logout</button>
        </form>
    </div>
</nav>
