export default function PrimaryButton({
    className = '',
    disabled,
    children,
    ...props
}) {
    return (
        <button
            {...props}
            className={
                `inline-flex items-center justify-center px-6 py-3 text-sm font-semibold rounded-lg transition-all duration-200 
                bg-blue-600 text-white shadow-md 
                hover:bg-blue-700 hover:brightness-110 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2
                active:scale-95 
                disabled:opacity-50 disabled:cursor-not-allowed 
                ` + className
            }
            disabled={disabled}
        >
            {children}
        </button>
    );
}