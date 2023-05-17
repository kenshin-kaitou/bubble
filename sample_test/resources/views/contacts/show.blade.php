<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            お問い合せ詳細
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section class="text-gray-600 body-font relative">
						<div class="container px-5 py-24 mx-auto">
							<div class="lg:w-1/2 md:w-2/3 mx-auto">
								<div class="flex flex-wrap -m-2">
									<div class="p-2 w-full">
										<div class="relative">
											<label for="name" class="leading-7 text-sm text-gray-600">氏名</label>
											<div type="text" id="name" name="name" >{{$contact->name}}</div>
										</div>
									</div>
									<div class="p-2 w-full">
										<div class="relative">
											<label for="title" class="leading-7 text-sm text-gray-600">件名</label>
											<div>{{$contact->title}}</div>
										</div>
									</div>
									<div class="p-2 w-full">
										<div class="relative">
											<label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
											<div>{{$contact->email}}</div>
										</div>
									</div>
									<div class="p-2 w-full">
										<div class="relative">
											<label for="url" class="leading-7 text-sm text-gray-600">ホームページ</label>
											@if($contact->url)
												<div>{{$contact->url}}</div>
											@endif
										</div>
									</div>
									<div class="p-2 w-full">
										<div class="relative">
											<label for="gender" class="leading-7 text-sm text-gray-600">性別</label><br>
											<div>{{$contact->gender}}</div>
										</div>
									</div>
									<div class="p-2 w-full">
										<div class="relative">
											<label for="age" class="leading-7 text-sm text-gray-600">年齢</label><br>
											<div>{{$contact->age}}</div>
										</div>
									</div>
									<div class="p-2 w-full">
										<div class="relative">
											<label for="contact" class="leading-7 text-sm text-gray-600">お問合せ内容</label>
											<div>{{$contact->contact}}</div>
										</div>
									</div>
									<form action="{{route("contacts.edit",$contact)}}">
										<div class="p-2 w-full">
											<button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">編集</button>
										</div>
									</form>
									<form action="{{route("contacts.destroy",$contact)}}" method="post">
										@csrf
										<div class="p-2 w-full">
											<button class="flex mx-auto text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">削除</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
