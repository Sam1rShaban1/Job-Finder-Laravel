import { Head } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function RandomText() {
    const randomTexts = [
        "The quick brown fox jumps over the lazy dog",
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit",
        "All that glitters is not gold",
        "A journey of a thousand miles begins with a single step",
        "Where there's a will, there's a way"
    ];

    const randomIndex = Math.floor(Math.random() * randomTexts.length);

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Random Text
                </h2>
            }
        >
            <Head title="Random Text" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            {randomTexts[randomIndex]}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
} 