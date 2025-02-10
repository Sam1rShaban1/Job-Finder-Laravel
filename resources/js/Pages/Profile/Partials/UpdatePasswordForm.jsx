import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Transition } from '@headlessui/react';
import { useForm } from '@inertiajs/react';
import { useRef } from 'react';

export default function UpdatePasswordForm({ className = '' }) {
    const passwordInput = useRef();
    const currentPasswordInput = useRef();

    const {
        data,
        setData,
        errors,
        put,
        reset,
        processing,
        recentlySuccessful,
    } = useForm({
        current_password: '',
        password: '',
        password_confirmation: '',
    });

    const updatePassword = (e) => {
        e.preventDefault();

        put(route('password.update'), {
            preserveScroll: true,
            onSuccess: () => reset(),
            onError: (errors) => {
                if (errors.password) {
                    reset('password', 'password_confirmation');
                    passwordInput.current.focus();
                }

                if (errors.current_password) {
                    reset('current_password');
                    currentPasswordInput.current.focus();
                }
            },
        });
    };

    return (
        <section className={`p-6 bg-white shadow-lg rounded-lg max-w-lg mx-auto ${className}`}>
            <header className="text-center">
                <h2 className="text-2xl font-bold text-blue-600">Change Password</h2>
                <p className="mt-1 text-sm text-gray-600">
                    Ensure your account is using a long, random password to stay secure.
                </p>
            </header>

            <form onSubmit={updatePassword} className="mt-6 space-y-6">
                <div>
                    <InputLabel
                        htmlFor="current_password"
                        value="Current Password"
                        className="text-gray-700 font-medium"
                    />

                    <TextInput
                        id="current_password"
                        ref={currentPasswordInput}
                        value={data.current_password}
                        onChange={(e) => setData('current_password', e.target.value)}
                        type="password"
                        className="mt-1 block w-full p-3 bg-blue-600 text-white rounded-lg focus:ring-2 focus:ring-blue-400"
                        autoComplete="current-password"
                    />

                    <InputError message={errors.current_password} className="mt-2 text-red-500" />
                </div>

                <div>
                    <InputLabel htmlFor="password" value="New Password" className="text-gray-700 font-medium" />

                    <TextInput
                        id="password"
                        ref={passwordInput}
                        value={data.password}
                        onChange={(e) => setData('password', e.target.value)}
                        type="password"
                        className="mt-1 block w-full p-3 bg-blue-600 text-white rounded-lg focus:ring-2 focus:ring-blue-400"
                        autoComplete="new-password"
                    />

                    <InputError message={errors.password} className="mt-2 text-red-500" />
                </div>

                <div>
                    <InputLabel
                        htmlFor="password_confirmation"
                        value="Confirm Password"
                        className="text-gray-700 font-medium"
                    />

                    <TextInput
                        id="password_confirmation"
                        value={data.password_confirmation}
                        onChange={(e) => setData('password_confirmation', e.target.value)}
                        type="password"
                        className="mt-1 block w-full p-3 bg-blue-600 text-white rounded-lg focus:ring-2 focus:ring-blue-400"
                        autoComplete="new-password"
                    />

                    <InputError message={errors.password_confirmation} className="mt-2 text-red-500" />
                </div>

                <div className="flex items-center justify-between">
                    <PrimaryButton
                        disabled={processing}
                        className="py-2 px-5 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700 transition duration-200"
                    >
                        Save Changes
                    </PrimaryButton>

                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <p className="text-sm text-green-600 font-medium">Password Updated!</p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}