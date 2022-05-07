<x-app-layout>
    <section class="text-gray-600 body-font">
      @if ($message = Session::get('success'))
        <div class="px-4 py-3 bg-green-200 mt-5 w-1/2 flex justify-center mx-auto rounded-lg " style="border: 2px solid rgb(22 163 74)">	
          <strong>{{ $message }}</strong>
        </div>
      @endif
      <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap -mx-4 -my-8">
        @foreach ($services as $item)
        <div class="py-8 px-4 lg:w-1/3 {{ $item->premium ? ' bg-yellow-200' : '' }}">
        <div class="h-full flex items-start">
            <div class="w-12 flex-shrink-0 flex flex-col text-center leading-none">
            <span class="text-gray-500 pb-2 mb-2 border-b-2 border-gray-200">{{ $item->created_at->format('M') }}</span>
            <span class="font-medium text-lg text-gray-800 title-font leading-none">{{ $item->created_at->format('d') }}</span>
            </div>
            <div class="flex-grow pl-6">
            <h1 class="title-font text-xl font-medium text-gray-900 mb-3">{{ $item->title }}</h1>
            <p class="leading-relaxed mb-5">{{ $item->content }}</p>
            <a class="inline-flex items-center">
                <img alt="blog" src="https://dummyimage.com/103x103" class="w-8 h-8 rounded-full flex-shrink-0 object-cover object-center">
                <span class="flex-grow flex flex-col pl-3">
                <span class="title-font font-medium text-gray-900">{{ $item->user->name }}</span>
                </span>
            </a>
            </div>
        </div>
        </div>
        @endforeach
        </div>
      </div>
    </section>
</x-app-layout>