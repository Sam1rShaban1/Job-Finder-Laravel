import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, usePage } from "@inertiajs/react";
import DeleteUserForm from "./Partials/DeleteUserForm";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm";
import Logo from "../Home/p-removebg-preview 1.png";

export default function Edit({ mustVerifyEmail, status }) {
    const user = usePage().props.auth.user; 

    return (
        <AuthenticatedLayout
            header={
                <div className="flex items-center justify-between px-6 py-4 bg-white shadow-md">

                    <img src={Logo} alt="JobFinder Logo" className="h-12" />


                    <a href="/dashboard/personal-information" className="text-lg font-semibold text-gray-800 dark:text-gray-200 hover:text-blue-600 transition duration-200">
                        {user.name}
                    </a>
                </div>
            }
        >
            <Head title="Profile" />

            <div className="py-12">
                <div className="mx-auto max-w-4xl space-y-6 sm:px-6 lg:px-8">


                    <div className="bg-white p-6 shadow-lg sm:rounded-lg dark:bg-gray-800">
                        <UpdateProfileInformationForm
                            mustVerifyEmail={mustVerifyEmail}
                            status={status}
                            className="max-w-xl"
                        />
                    </div>


                    <div className="bg-white p-6 shadow-lg sm:rounded-lg dark:bg-gray-800">
                        <UpdatePasswordForm className="max-w-xl" />
                    </div> 


                    <div className="bg-white p-6 shadow-lg sm:rounded-lg dark:bg-gray-800">
                        <h3 className="text-lg font-semibold text-red-600 mb-4">Delete Account</h3>
                        <DeleteUserForm className="max-w-xl" />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}