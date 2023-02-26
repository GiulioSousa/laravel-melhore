<x-layout 
    title="{{ $title }}" 
    :style="$style"
>
    <x-header 
        :login="$user->login" 
        :home="$home" 
        :avatar="$user->avatar" 
    />
    <x-metric.form 
        :title="'Editar Métrica'" 
        :route="$route" 
        :array-data="$arrayData" 
        :metric="$metric" 
    />
    <x-footer />
</x-layout>