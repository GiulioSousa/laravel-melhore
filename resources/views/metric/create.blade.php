<x-layout title="{{ $title }}" :style="$style">
    <x-header :login="$user->login" :home="$home" :avatar="$user->avatar" />
        <x-metric.form :title="'Nova Métrica'" :route="$route" :array-data="$arrayData" />
    <x-footer />
</x-layout>