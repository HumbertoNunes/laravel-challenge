<template>
    <section class="max-w-xl">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                <slot name="title"></slot>
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                <slot name="subtitle"></slot>
            </p>
        </header>

        <slot />
    </section>
</template>
