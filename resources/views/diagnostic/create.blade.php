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
        :title="'Novo Diagnóstico'" 
        :route="$route" 
        :array-data="$arrayData"
    />
    <x-footer />
</x-layout>