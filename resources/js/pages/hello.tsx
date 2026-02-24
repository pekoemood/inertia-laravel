type Props = {
    name: string
}

import { Link, useForm, usePage } from "@inertiajs/react";
import React, { type FormEvent } from "react";

export default function Hello({ name }: { name: string } ) {
    const { data, setData, post, errors, processing } = useForm({
        message: 'なにか文字をいれてね！',
    });

    const { props } = usePage();

    function submit(e: React.SyntheticEvent<HTMLFormElement>) {
        e.preventDefault();
        post('/hello');
    }

    return (
        <div>
            <h1>Hello, {name}</h1>

            {props.flash?.success && <p>{props.flash.success}</p>}

            <form onSubmit={submit}>
                <input
                    value={data.message}
                    onChange={e => setData('message', e.target.value)}
                    />
                    {errors.message && <p>{errors.message}</p>}
                    <button disabled={processing}>送信</button>
            </form>

            <Link href="/about">About -></Link>
        </div>
    )
}
