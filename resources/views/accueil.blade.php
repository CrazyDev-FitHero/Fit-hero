@extends('layouts.base')

@section('title', 'Accueil')

@section('content')

@include('layouts.navigation')


    <div class="flex h-full">
        <!-- Sidebar -->
        <div class="w-20 bg-[#002F34] flex flex-col justify-between items-center py-5">
            <img src="trophy-icon.png" alt="Trophy" class="w-10 mb-5">
            <img src="user-icon.png" alt="User" class="w-10 mb-5">
            <div class="mb-5 text-center">
                <img src="logout-icon.png" alt="Logout" class="w-12 mb-2">
                <p class="text-white text-xs">SE DÉCONNECTER</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex justify-center items-center p-5">
            <div class="bg-[#424D84] rounded-2xl p-5 shadow-lg w-[600px] h-[300px] flex">
                <!-- Left Panel -->
                <div class="flex flex-col items-center text-white w-1/2 relative">
                    <canvas id="patternCanvas" width="300" height="300" class="absolute top-0 left-0 z-[-1] pointer-events-none"></canvas>
                    <div class="grid grid-cols-3 gap-10 relative">
                        <div data-index="0" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center"></div>
                        <div data-index="1" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center"></div>
                        <div data-index="2" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center"></div>
                        <div data-index="3" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center"></div>
                        <div data-index="4" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center"></div>
                        <div data-index="5" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center"></div>
                        <div data-index="6" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center"></div>
                        <div data-index="7" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center"></div>
                        <div data-index="8" class="w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center"></div>
                    </div>
                    <div class="mt-5 text-xl">STR: 400</div>
                </div>

                <!-- Right Panel -->
                <div class="flex justify-center items-center w-1/2 bg-[#6c8b96] rounded-2xl">
                    <img src="flexing-icon.png" alt="Flexing" class="w-30">
                </div>
            </div>
        </div>
    </div>

@endsection
