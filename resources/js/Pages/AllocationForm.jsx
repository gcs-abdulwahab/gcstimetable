import React, { useEffect } from 'react';
import { Head } from '@inertiajs/react'


function HelloWorld({ allocations }) {


    function handleSubmit(e) {
        e.preventDefault()
    }

    useEffect(() => {
        console.log(allocations)
    }, [allocations])

    return (
        <>
            <Head title="Hello World!" />
            <div>
                <h1 className='text-2xl font-bold flex justify-center pt-10'>Hello World!</h1>
            </div>
        </>
    );
}

export default HelloWorld;
