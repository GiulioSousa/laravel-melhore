<x-layout title="{{ $title }}" :style="$style">
    <x-header :login="$user->login" :home="$home" :avatar="$user->avatar" />
        <x-video.form :title="'Editar Video'" :video="$video" :route="$route" :array-data="$arrayData" />
    <x-footer />
</x-layout>