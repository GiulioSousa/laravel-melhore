<x-layout 
    title="{{ $title }}" 
    :style="$style">
    <x-header 
        :login="$user->login" 
        :home="$home" 
        :avatar="$user->avatar" />
        <x-video.form 
            :title="'Novo Video'" 
            :route="$route" 
            :array-data="$arrayData" />
    <x-footer/>
</x-layout>