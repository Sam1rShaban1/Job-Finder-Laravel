import DangerButton from '@/Components/DangerButton';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import Modal from '@/Components/Modal';
import SecondaryButton from '@/Components/SecondaryButton';
import TextInput from '@/Components/TextInput';
import { useForm } from '@inertiajs/react';
import { useRef, useState } from 'react';

export default function DeleteUserForm({ className = '' }) {
    const [confirmingUserDeletion, setConfirmingUserDeletion] = useState(false);
    const passwordInput = useRef();

    const {
        data,
        setData,
        delete: destroy,
        processing,
        reset,
        errors,
        clearErrors,
    } = useForm({
        password: '',
    });

    const confirmUserDeletion = () => {
        setConfirmingUserDeletion(true);
    };

    const deleteUser = (e) => {
        e.preventDefault();

        destroy(route('profile.destroy'), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => passwordInput.current.focus(),
            onFinish: () => reset(),
        });
    };

    const closeModal = () => {
        setConfirmingUserDeletion(false);
        clearErrors();
        reset();
    };

    return (
        <section className={`space-y-6 ${className}`}>
            <header className="text-center">
                <h2 className="text-2xl font-bold text-red-600">Delete Account</h2>
                <p className="mt-2 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently erased. 
                    Please download any data you wish to retain.
                </p>
            </header>

            <div className="flex justify-center">
                <DangerButton className="py-2 px-6 text-lg" onClick={confirmUserDeletion}>
                    Delete Account
                </DangerButton>
            </div>

            {/* ✅ Modern Modal UI */}
            <Modal show={confirmingUserDeletion} onClose={closeModal}>
                <div className="bg-white p-8 rounded-xl shadow-xl w-[450px] relative">
                    
                    {/* Close Button */}
                    <button
                        onClick={closeModal}
                        className="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-xl"
                    >
                        ✖
                    </button>

                    <h2 className="text-2xl font-semibold text-red-600 text-center mb-6">
                        Confirm Account Deletion
                    </h2>

                    <p className="text-sm text-gray-600 text-center">
                        Deleting your account will remove all your data permanently. 
                        Please enter your password to confirm.
                    </p>

                    <div className="mt-6">
                        <InputLabel htmlFor="password" value="Password" className="sr-only" />

                        <TextInput
                            id="password"
                            type="password"
                            name="password"
                            ref={passwordInput}
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                            className="w-full p-3 border border-gray-300 rounded-lg text-sm bg-gray-200 focus:ring-2 focus:ring-red-500 transition duration-200"
                            placeholder="Enter Password"
                        />

                        <InputError message={errors.password} className="mt-2 text-red-500" />
                    </div>

                    <div className="mt-6 flex justify-between">
                        <SecondaryButton 
                            onClick={closeModal} 
                            className="py-2 px-5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200"
                        >
                            Cancel
                        </SecondaryButton>

                        <DangerButton 
                            className="py-2 px-5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200" 
                            disabled={processing}
                        >
                            Delete
                        </DangerButton>
                    </div>
                </div>
            </Modal>
        </section>
    );
}