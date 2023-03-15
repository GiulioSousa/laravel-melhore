<x-layout 
    title="{{ $title }}" 
    :style="$style"
>
    <x-header 
        :login="$user->login" 
        :home="$home" 
        :avatar="$user->avatar" 
    />
    <x-diagnostic.form 
        :title="'Editar Diagnóstico'" 
        :route="$route" 
        :array-data="$arrayData"
        :diagnostic="$diagnostic"
    />
    <x-footer />
</x-layout>