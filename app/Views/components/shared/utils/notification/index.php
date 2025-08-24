
<div component='notification' class="cursor-pointer relative">
    <div component='notification:icon' popup='notifications'>
        <i class="bi bi-bell-fill text-hover text-xl"></i>
    </div>
    <div component='notification:popup' target-popup='notifications' class="absolute right-0 min-w-[15rem] shadow bg-light pb-3 border-accent border-2 shadow rounded-md">
        <div class="message-title text-center text-light bg-accent p-1">
            <span><strong>Notificações</strong></span>
        </div>
        <div component='notification:content' class="message-content px-1 overflow-y-auto h-[35vh]">
            <div class="text-center mt-6">
                <span class="text-md text-gray-500">Não há notificações</span>
            </div>
        </div>
    </div>
</div>