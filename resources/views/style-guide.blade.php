<x-app-layout>
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">

        <h1 class="text-4xl font-bold mb-8 pb-2 border-b border-gray-200 dark:border-gray-700">Style Guide</h1>

        <!-- Section: Colors -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold mb-6">Colors</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                
                <div class="text-center">
                    <div class="w-full h-24 rounded-lg bg-primary-500 mb-2"></div>
                    <p class="font-medium">Primary</p>
                    <p class="text-sm opacity-70">bg-primary-500</p>
                </div>

                <div class="text-center">
                    <div class="w-full h-24 rounded-lg bg-secondary-500 mb-2"></div>
                    <p class="font-medium">Secondary</p>
                    <p class="text-sm opacity-70">bg-secondary-500</p>
                </div>

                <div class="text-center">
                    <div class="w-full h-24 rounded-lg bg-accent-500 mb-2"></div>
                    <p class="font-medium">Accent</p>
                    <p class="text-sm opacity-70">bg-accent-500</p>
                </div>

                <div class="text-center">
                    <div class="w-full h-24 rounded-lg bg-neutral-200 dark:bg-neutral-800 mb-2"></div>
                    <p class="font-medium">Neutral</p>
                    <p class="text-sm opacity-70">bg-neutral-200</p>
                </div>

                <div class="text-center">
                    <div class="w-full h-24 rounded-lg bg-base-100 border border-neutral-200 dark:border-neutral-700 mb-2"></div>
                    <p class="font-medium">Base</p>
                    <p class="text-sm opacity-70">bg-base-100</p>
                </div>

            </div>
        </section>

        <!-- Section: Typography -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold mb-6">Typography</h2>
            <div class="space-y-6">
                <div>
                    <h1 class="text-4xl font-bold">Heading 1: The quick brown fox jumps over the lazy dog.</h1>
                    <p class="font-light">(font-bold, text-4xl)</p>
                </div>
                <div>
                    <h2 class="text-3xl font-semibold">Heading 2: The quick brown fox jumps over the lazy dog.</h2>
                    <p class="font-light">(font-semibold, text-3xl)</p>
                </div>
                <div>
                    <h3 class="text-2xl font-medium">Heading 3: The quick brown fox jumps over the lazy dog.</h3>
                    <p class="font-light">(font-medium, text-2xl)</p>
                </div>
                <div class="max-w-3xl">
                    <p class="text-base font-normal"><b>Paragraph (normal):</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.</p>
                </div>
                <div class="max-w-3xl">
                    <p class="text-base font-light"><b>Paragraph (light):</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.</p>
                </div>
                 <div class="max-w-3xl">
                    <p class="text-base font-extralight"><b>Paragraph (extralight):</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.</p>
                </div>
            </div>
        </section>

        <!-- Section: Buttons -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold mb-6">Buttons</h2>
            <div class="flex flex-wrap items-center gap-6">
                <button class="btn bg-primary-500 text-white px-6 py-2 rounded-lg font-medium hover:bg-primary-600 transition-colors">Primary Button</button>
                <button class="btn bg-secondary-500 text-white px-6 py-2 rounded-lg font-medium hover:bg-secondary-600 transition-colors">Secondary Button</button>
                <button class="btn bg-accent-500 text-black px-6 py-2 rounded-lg font-medium hover:bg-accent-600 transition-colors">Accent Button</button>
                <button class="btn border border-danger-500 text-danger-500 px-6 py-2 rounded-lg font-medium hover:bg-danger-500 hover:text-white dark:hover:text-white transition-colors">Danger Button</button>
            </div>
        </section>

        <!-- Section: Forms -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold mb-6">Forms</h2>
            <div class="max-w-xl grid grid-cols-1 gap-y-6">

                <div>
                    <label for="text-input" class="block text-sm font-medium mb-1">Text Input</label>
                    <input type="text" name="text-input" id="text-input" class="block w-full bg-gray-100 dark:bg-neutral-800 border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="you@example.com">
                </div>

                <div>
                    <label for="text-input-error" class="block text-sm font-medium mb-1">Input with Error</label>
                    <input type="text" name="text-input-error" id="text-input-error" class="block w-full bg-gray-100 dark:bg-neutral-800 border-danger-500 rounded-md shadow-sm focus:ring-danger-500 focus:border-danger-500 sm:text-sm" value="invalid-entry">
                    <p class="mt-2 text-sm text-danger-500">This field has an error.</p>
                </div>

                <div>
                    <label for="textarea" class="block text-sm font-medium mb-1">Textarea</label>
                    <textarea id="textarea" name="textarea" rows="4" class="block w-full bg-gray-100 dark:bg-neutral-800 border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="Your message..."></textarea>
                </div>

                <div>
                    <label for="select" class="block text-sm font-medium mb-1">Select</label>
                    <select id="select" name="select" class="block w-full bg-gray-100 dark:bg-neutral-800 border-gray-300 dark:border-neutral-700 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                        <option>Option 1</option>
                        <option>Option 2</option>
                        <option>Option 3</option>
                    </select>
                </div>

                <fieldset>
                    <legend class="text-base font-medium">Checkboxes</legend>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="checkbox1" name="checkbox1" type="checkbox" class="h-4 w-4 bg-gray-100 dark:bg-neutral-700 border-gray-300 dark:border-neutral-600 rounded text-primary-600 focus:ring-primary-500">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="checkbox1">Option A</label>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="checkbox2" name="checkbox2" type="checkbox" class="h-4 w-4 bg-gray-100 dark:bg-neutral-700 border-gray-300 dark:border-neutral-600 rounded text-primary-600 focus:ring-primary-500" checked>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="checkbox2">Option B (checked)</label>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend class="text-base font-medium">Radio Buttons</legend>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-center">
                            <input id="radio1" name="radio-group" type="radio" class="h-4 w-4 bg-gray-100 dark:bg-neutral-700 border-gray-300 dark:border-neutral-600 rounded text-primary-600 focus:ring-primary-500">
                            <label for="radio1" class="ml-3 block text-sm font-medium">Choice 1</label>
                        </div>
                        <div class="flex items-center">
                            <input id="radio2" name="radio-group" type="radio" class="h-4 w-4 bg-gray-100 dark:bg-neutral-700 border-gray-300 dark:border-neutral-600 rounded text-primary-600 focus:ring-primary-500" checked>
                            <label for="radio2" class="ml-3 block text-sm font-medium">Choice 2 (selected)</label>
                        </div>
                    </div>
                </fieldset>

            </div>
        </section>

        <!-- Section: How to Customize -->
        <section>
            <h2 class="text-3xl font-semibold mb-6">How to Customize</h2>
            <div class="bg-gray-50 dark:bg-neutral-800 p-6 rounded-lg prose prose-lg max-w-none dark:prose-invert">
                <p>
                    Для изменения цветовой схемы сайта, вам необходимо отредактировать файл конфигурации Tailwind CSS.
                </p>
                <ol>
                    <li>
                        <strong>Откройте файл:</strong>
                        <code class="text-sm bg-gray-200 dark:bg-neutral-700 rounded px-2 py-1">tailwind.config.js</code>
                    </li>
                    <li>
                        <strong>Найдите секцию <code>theme.extend.colors</code>:</strong>
                        В этом объекте определены все основные цвета, используемые в проекте.
                    </li>
                    <li>
                        <strong>Измените цвета:</strong>
                        Вы можете изменить основные цвета (<code>primary</code>, <code>secondary</code>, <code>accent</code>), а также цвета для светлой (<code>base-100</code>, <code>base-content</code>) и темной (<code>dark-base-100</code>, <code>dark-base-content</code>) тем.
                    </li>
                    <li>
                        <strong>Пересоберите CSS:</strong>
                        После сохранения изменений, выполните в терминале команду <code>npm run build</code>, чтобы применить изменения.
                    </li>
                </ol>
                <p>
                    Например, чтобы изменить основной цвет на фиолетовый, вы можете заменить <code>primary: colors.blue</code> на <code>primary: colors.violet</code>.
                </p>
            </div>
        </section>

    </div>
</x-app-layout>