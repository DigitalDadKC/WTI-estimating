<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6 mb-4 max-h-96 overflow-auto'])}}>
    <h1>{{$title}}</h1>
    {{$slot}}
  </div>