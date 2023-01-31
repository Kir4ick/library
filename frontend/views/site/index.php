<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>

<div class="mt-8 ">
    <div class="container">
        <!-- Контент на главной странице -->
        <main class="bg-white rounded-xl grid grid-cols-5">
            <!-- Фильтры -->
            <div class="filters h-full border-r-[1px] p-5">
                <form id="filter-form" method="get">

                    <label for="">
                        Что-то ищете?
                        <input class="bg-gray-300 mt-2 block border border-slate-300 rounded-md py-2 pr-3 shadow-sm
                            focus:outline-none focus:border-cyan-800 focus:ring-cyan-800 focus:ring-1 px-1 w-full h-8" type="text" id="search" name="title">
                    </label>

                    <div class="filters-book__type_busy mt-5">
                        <div class="filter-busy">
                            <input type="radio" id="free" name="status" value="true" class="hidden peer">
                            <label for="free" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-cyan-800 peer-checked:border-cyan-800 peer-checked:text-cyan-800 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <div class="w-full text-md font-semibold">Свободные книги</div>
                                </div>
                            </label>
                        </div>

                        <div class="filter-busy mt-3">
                            <input type="radio" id="busy" name="status" value="false" class="hidden peer">
                            <label for="busy" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-cyan-800 peer-checked:border-cyan-800 peer-checked:text-cyan-800 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <div class="w-full text-md font-semibold">Занятые книги</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="filters-buttons mt-4">
                        <button class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300
                        rounded-md text-sm w-full sm:w-auto px-5 py-2.5 text-center" type="submit">Искать</button>

                        <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-cyan-300
                        rounded-md text-sm w-full sm:w-auto px-5 py-2.5 text-center" type="reset">Сбросить</button>
                    </div>

                </form>
            </div>

            <div class="overflow-x-auto shadow-md sm:rounded-lg flex h-full flex-col justify-between col-start-2 col-end-6 p-6">
                <!-- Книги -->
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Название
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Дата поступления
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Автор
                        </th>
                        <th scope="col" class="px-6 py-3">
                            В наличии
                        </th>
                    </tr>
                    </thead>
                    <tbody class="table-books">
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Гарри Поттер
                        </th>
                        <td class="px-6 py-4">
                            23 декабря, 2022
                        </td>
                        <td class="px-6 py-4">
                            Пушкин, Лермонтов
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-cyan-700 dark:text-cyan-500 hover:underline">Да</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!-- Пагинация -->
                <nav class="flex items-center justify-between pt-4" aria-label="Table navigation">
                    <ul class="pagination-list inline-flex items-center -space-x-px">

                    </ul>
                </nav>
            </div>
            </div>
        </main>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    let filters = {
        expand:"authors"
    };

    function getBooks(filters){
        $.ajax({
            url: 'http://library/api/v1/book',
            method: 'GET',
            data: filters,
            success: function (data) {
                createPagination(data.data._links, data.data._meta);
                createBooks(data.data.items);
            }
        });

        function createPagination(dataPagination, meta){
            pagination = $('.pagination-list');
            pagination.empty();
            pagination.append(`
                <li>
                    <a href="${dataPagination.first.href}" data-link="1" class="pagination-link block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Previous</span>
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </a>
                </li>
            `);
            if(meta.currentPage !== 1) {
                pagination.append(`
                <li>
                    <a href="${dataPagination.first.href}" class="pagination-link px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                </li>
                `);
            }
            pagination.append(`
                <li>
                    <a href="${dataPagination.self.href}" data-link="${meta.currentPage}" class="pagination-link px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">${meta.currentPage}</a>
                </li>
            `);

            if(meta.currentPage !== meta.pageCount) {
                pagination.append(`
                <li>
                    <a href="${dataPagination.next.href}" data-link="${meta.currentPage + 1}" class="pagination-link px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">${meta.currentPage + 1}</a>
                </li>
            `);
            }
            pagination.append(`
                <li>
                    <a href="${dataPagination.last.href}" data-link="${meta.pageCount}" class="pagination-link block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Next</span>
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </a>
                </li>
            `);

            $('.pagination-link').each(function (e, element){
                $(element).on('click', function (event){
                    event.preventDefault();
                    filters.page = $(element).attr('data-link');
                    getBooks(filters);
                })
            });
        }

        function createBooks(books){
            tableBooks = $('.table-books');
            tableBooks.empty();
            for (let book of books) {
                tableBooks.append(`
                <tr class="book bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        ${book.title}
                    </th>
                    <td class="px-6 py-4">
                        ${book.date_receipt}
                    </td>
                    <td class="px-6 py-4">
                        ${setAuthors(book.authors)}
                    </td>
                    <td class="px-6 py-4">
                        <a class="font-medium text-cyan-700 dark:text-cyan-500 hover:underline">${setStatus(book.status)}</a>
                    </td>
                </tr>
                `);

                function setAuthors(authors){
                    let string = '';
                    for (let author of authors) {
                        string += (author.name + ', ');
                    }
                    return string.substring(0, string.length - 2);
                }

                function setStatus(status){
                    if(!status){
                        return 'Нет в наличии';
                    }
                    return 'В наличии';
                }
            }
        }
    }

    function submitForm(){
        $('#filter-form').submit(function (e) {
            e.preventDefault();
            title = $('#search').val();
            bookStatus = $('input[name="status"]:checked').val();

            if(title !== ''){
                filters.title = title;
            }

            if(bookStatus !== undefined){
                filters.status = bookStatus;
            }

            getBooks(filters);
        })
    }

    submitForm();
    getBooks(filters);
</script>