import ApplicationLogo from '@/Components/ApplicationLogo';
import Dropdown from '@/Components/Dropdown';
import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function AuthenticatedLayout({ header, children }) {
    const user = usePage().props.auth.user;

    return (
        <div className="min-h-screen bg-gray-100 dark:bg-gray-900">


            <nav className="border-b border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800">
                <div className="mx-auto max-w-7xl px-6 sm:px-8 lg:px-10">
                    <div className="flex h-16 justify-between items-center">
                        

                        <Link href="/">
                            <ApplicationLogo className="h-10 w-auto fill-current text-blue-600 dark:text-white" />
                        </Link>


                        <div className="relative">
                            <Dropdown>
                                <Dropdown.Trigger>
                                    <button
                                        type="button"
                                        className="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 focus:outline-none dark:text-gray-300 dark:hover:text-white"
                                    >
                                        {user.name}
                                        <svg
                                            className="ml-2 h-4 w-4 text-blue-500"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fillRule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clipRule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </Dropdown.Trigger>

                                <Dropdown.Content className="bg-white shadow-lg rounded-md">
                                    <Dropdown.Link href={route('profile.edit')} className="hover:bg-blue-50 hover:text-blue-700">
                                        Profile
                                    </Dropdown.Link>
                                    <Dropdown.Link
                                        href={route('logout')}
                                        method="post"
                                        as="button"
                                        className="hover:bg-red-50 hover:text-red-600"
                                    >
                                        Log Out
                                    </Dropdown.Link>
                                </Dropdown.Content>
                            </Dropdown>
                        </div>
                    </div>
                </div>
            </nav>

            {/* Page Header */}
            {header && (
                <header className="bg-white shadow dark:bg-gray-800">
                    <div className="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {header}
                    </div>
                </header>
            )}

            {/* Page Content */}
            <main className="mt-6 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                {children}
            </main>
        </div>
    );
}