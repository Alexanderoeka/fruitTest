import React from "react";
import g from 'general.module.css';

interface propsI {
    value?: string | number | undefined
}

export default function Input(props: propsI) {
    return (
        <div>
            <input type="text" value={props.value}/>
        </div>
    )
}