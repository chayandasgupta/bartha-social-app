@extends('layouts.app')
@section('content') 
    <!-- Cover Container -->
    <section
        class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[350px] space-y-8 flex items-center flex-col justify-center">
        <!-- Profile Info -->
        <div class="flex gap-4 justify-center flex-col text-center items-center">
        <!-- User Meta -->
        <div>
            <h1 class="font-bold md:text-2xl">{{$user->name}}</h1>
            <p class="text-gray-700">{{$user->bio ?? ''}}</p>
        </div>
        <!-- / User Meta -->
        </div>
        <!-- /Profile Info -->

        <!-- Profile Stats -->
        <div
        class="flex flex-row gap-16 justify-center text-center items-center">
            <!-- Total Posts Count -->
            <div class="flex flex-col justify-center items-center">
                <h4 class="sm:text-xl font-bold">{{ $user->totalPosts ?? 0 }}</h4>
                <p class="text-gray-600">Posts</p>
            </div>

            <!-- Total Comments Count -->
            <div class="flex flex-col justify-center items-center">
                <h4 class="sm:text-xl font-bold">{{ $user->totalComments ?? 0 }}</h4>
                <p class="text-gray-600">Comments</p>
            </div>
        </div>
        <!-- /Profile Stats -->

        <!-- Edit Profile Button (Only visible to the profile owner) -->
        @if(auth()->user()->uuid == $user->uuid)
            <a
            href="{{ route('profile.edit', $user->uuid) }}"
            type="button"
            class="-m-2 flex gap-2 items-center rounded-full px-4 py-2 font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5">
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
            </svg>
                Edit Profile
            </a>
        @endif
        <!-- /Edit Profile Button -->
    </section>
    <!-- /Cover Container -->
    
    <!-- Barta Create Post Card -->
    @if(auth()->user()->uuid == $user->uuid)
        <form
        method="POST"
        action="{{route('post.store')}}"
        class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3">
        @csrf
            <!-- Create Post Card Top -->
            <div>
            <div class="flex items-start /space-x-3/">
                <!-- Content -->
                <div class="text-gray-700 font-normal w-full">
                <textarea
                    class="block w-full p-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
                    name="description"
                    rows="2"
                    placeholder="What's going on, {{ auth()->check() ? auth()->user()->user_name : '' }}?"></textarea>
                </div>
            </div>
            </div>

            <!-- Create Post Card Bottom -->
            <div>
            <!-- Card Bottom Action Buttons -->
            <div class="flex items-center justify-end">
                <div>
                <!-- Post Button -->
                <button
                    type="submit"
                    class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                    Post
                </button>
                <!-- /Post Button -->
                </div>
            </div>
            <!-- /Card Bottom Action Buttons -->
            </div>
            <!-- /Create Post Card Bottom -->
        </form>
    @endauth
    <!-- /Barta Create Post Card -->

    <!-- User Specific Posts Feed -->
      <!-- Barta Card -->
      @if($user->posts && count($user->posts) > 0)
        @foreach ($user->posts as $post)
            <article class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
                <header>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <img
                        class="h-10 w-10 rounded-full object-cover"
                        src="https://avatars.githubusercontent.com/u/55105548"
                        alt="Chayan" />
                    </div>

                    <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                        <a
                        href="{{route('profile.show', $user->uuid)}}"
                        class="hover:underline font-semibold line-clamp-1">
                            {{$user->name ?? ''}} 
                        </a>

                        <a
                        href="{{route('profile.show', $user->uuid)}}"
                        class="hover:underline text-sm text-gray-500 line-clamp-1">
                        {{'@'.$user->user_name ?? ''}}
                        </a>
                    </div>
                    </div>

                    <!-- Card Action Dropdown -->
                    @if(auth()->check() && auth()->user()->id == $post->user_id)
                        <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                        <div class="relative inline-block text-left">
                            <div>
                            <button
                                @click="open = !open"
                                type="button"
                                class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                id="menu-0-button">
                                <span class="sr-only">Open options</span>
                                <svg
                                class="h-5 w-5"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true">
                                <path
                                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>
                                </svg>
                            </button>
                            </div>
                            <!-- Dropdown menu -->
                            <div
                                x-show="open"
                                @click.away="open = false"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="user-menu-button"
                                tabindex="-1">
                                <a href="{{ route('post.edit', $post->uuid) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem"
                                        tabindex="-1"
                                        id="user-menu-item-0"
                                >Edit</a>
                                
                                <form id="de-form-{{ $post->uuid }}" type="submit" action="{{ route('post.destroy', $post->uuid) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem"
                                tabindex="-1"
                                id="user-menu-item-1" onclick="event.preventDefault(); document.getElementById('de-form-{{ $post->uuid }}').submit();">Delete</a>
                            </div>
                            <!-- Dropdown menu end -->
                        </div>
                        </div>
                    @endif
                    <!-- /Card Action Dropdown -->
                </div>
                </header>

                <div class="py-4 text-gray-700 font-normal">
                <p>
                    {{ Str::limit(strip_tags($post->description), 400) }}
                    @if (strlen(strip_tags($post->description)) > 400)
                    <a href="{{ route('post.show', $post->uuid) }}" class="text-blue-500 text-sm">Read More</a>
                    @endif

                </p>
                </div>

                <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                <span class="">6 minutes ago</span>
                <span class="">•</span>
                <span>450 views</span>
                </div>

                <footer class="border-t border-gray-200 pt-2">
                {{-- &lt;!&ndash; Card Bottom Action Buttons &ndash;&gt; --}}
                <div class="flex items-center justify-between">
                    <div class="flex gap-8 text-gray-600">
                    {{-- &lt;!&ndash; Heart Button &ndash;&gt; --}}
                    <button
                        type="button"
                        class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                        <span class="sr-only">Like</span>
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-5 h-5">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>

                        <p>36</p>
                    </button>
                    {{-- &lt;!&ndash; /Heart Button &ndash;&gt;

                    &lt;!&ndash; Comment Button &ndash;&gt; --}}
                    <a href="{{ route('post.show', $post->uuid) }}" type="button"
                            class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                            <span class="sr-only">Comment</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                            </svg>

                            <p>{{ $post->comment_count }}</p>
                        </a>
                    {{-- &lt;!&ndash; /Comment Button &ndash;&gt; --}}
                    </div>

                    <div>
                    {{-- &lt;!&ndash; Share Button &ndash;&gt; --}}
                    <button
                        type="button"
                        class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                        <span class="sr-only">Share</span>
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                        </svg>
                    </button>
                    {{-- &lt;!&ndash; /Share Button &ndash;&gt; --}}
                    </div>
                </div>
                {{-- &lt;!&ndash; /Card Bottom Action Buttons &ndash;&gt; --}}
                </footer>
            </article>
        @endforeach
      @endif
      <!-- /Barta Card -->
      <!-- User Specific Posts Feed -->
@endsection