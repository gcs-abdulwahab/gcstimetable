// write a component that displays a welcome message
import React from 'react';
import { Head, Link, router } from '@inertiajs/react'

function Welcome() {
    return (
        <>
            <Head title="Welcome!" />
            <div>
                <h1 className='text-2xl font-bold flex justify-center pt-10'>Welcome!</h1>
                <div className='flex justify-center pt-10'>
                    <Link href='/allocations/create'>
                        Create Allocation
                    </Link>
                </div>
            </div>
        </>
    );
}

export default Welcome;