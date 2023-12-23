<div>

    <div>
        <button wire:click="toggleModal">modal</button>
        @if($showModal)
        <div wire:click="toggleModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg  w-1/3">
                <p>form update Data</p>
                <form action="/" method="post">
                    <input type="text" class=" py-1 w-full">
                </form>
            </div>
        </div>
        @endif
    </div>

</div>