<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css'])
    <title>Store User</title>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen py-10">
        <div class="mx-auto max-w-3xl px-4">

            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <form action="{{ route('user.create') }}" method="POST" class="grid gap-4 sm:grid-cols-2">
                    @csrf
                    <div class="sm:col-span-1">
                        <label for="name" class="mb-1 block text-sm font-medium text-gray-700">Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        @error('name')
                            <div style="color:red; font-size:12px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-1">
                        <label for="email" class="mb-1 block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        @error('email')
                            <div style="color:red; font-size:12px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-1">
                        <label for="phone" class="mb-1 block text-sm font-medium text-gray-700">Phone</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        @error('phone')
                            <div style="color:red; font-size:12px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit"
                            class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Save to Session
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
