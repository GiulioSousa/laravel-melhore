<x-layout title="{{ $title }}" :style="$style" >
    <x-header :login="$login" :home="$home" :avatar="$user->avatar" />
    <x-footer />
</x-layout>