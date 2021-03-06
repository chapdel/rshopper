@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

<div x-data class="bg-white dark:bg-gray-800 rounded-lg p-4 sm:p-6 shadow-md">
    <div class="pb-5 border-b border-gray-200 dark:border-gray-700 space-y-3 sm:flex sm:items-center sm:justify-between sm:space-x-4 sm:space-y-0">
        <div class="flex-1 min-w-0 max-w-2xl">
            <h2 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">{{ __('Product Attributes') }}</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 leading-5">
                {{ __('All the attributes associated with this product.') }}
            </p>
        </div>
        <div>
            <x-shopper-button wire:click="$emit('openModal', 'shopper-modals.add-product-attribute', {{ json_encode([$product->id, $attributes]) }})" type="button">
                {{ __('Add attribute') }}
            </x-shopper-button>
        </div>
    </div>

    <dl class="divide-y divide-gray-200 dark:divide-gray-700">
        @forelse($productAttributes as $productAttribute)
            <div wire:key="product-attribute-{{ $productAttribute->id }}" class="py-4 space-y-1 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 @if(! $loop->first) sm:pt-5 @endif">
                <dt class="text-sm leading-5 font-medium text-gray-500 dark:text-gray-400">
                    {{ __($productAttribute->attribute->name) }}
                </dt>
                <dd class="flex space-x-4 text-sm leading-5 text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                    @if($productAttribute->values->count() <= 1)
                        @if(in_array($productAttribute->type, ['richtext', 'markdown']))
                            <div class="flex-grow">
                                {{ str_limit(strip_tags(nl2br($productAttribute->values->first()->real_value)), 157) }}
                            </div>
                        @else
                            <span class="flex-grow">{{ $productAttribute->values->first()->real_value }}</span>
                        @endif
                    @else
                        <span class="flex-grow">WIP</span>
                    @endif
                    <span class="flex-shrink-0 flex items-start space-x-4">
                        <button wire:click="removeProductAttribute({{ $productAttribute->id }})" type="button" class="font-medium text-blue-600 hover:text-blue-500 transition duration-150 ease-in-out">
                            {{ __('Remove') }}
                        </button>
                  </span>
                </dd>
            </div>
        @empty
            <div class="py-4 space-y-1 sm:py-6">
                <div class="flex justify-center items-center space-x-2">
                    <x-heroicon-o-clipboard-list class="h-8 w-8 text-gray-400" />
                    <span class="font-medium py-8 text-gray-400 dark:text-gray-300 text-xl">{{ __('No attributes') }}</span>
                </div>
            </div>
        @endforelse
    </dl>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
