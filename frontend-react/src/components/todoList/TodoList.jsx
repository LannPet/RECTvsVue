import { useState } from "react";
import axios from "axios";
import "./todoList.css";

export default function TodoList() {
    const [newItem, setNewItem] = useState("");
    const [list, setList] = useState(["Walk the dog", "Take the trash out", "Buy a new Car"]);

    const handleClick = async (e) => {
        e.preventDefault();

        if (!newItem) return;

        setList([...list, newItem]);  // Add the new item to the list

        const response = await axios.post('http://localhost:8000/todo/add_item', newItem, 
            {
                headers: {
                'Content-Type': 'text/plain'
            }
          });

        if(!response) return;

        console.log("response", response)
        

        setNewItem("");  // Clear the input field
    };

    const handleDelete = (index) => {
        setList(list.filter((_, i) => i !== index));  // Remove item by index
    };

    return (
        <>
            <section className="todolist-container">
                <div className="header-container">
                    <h1>TODO LIST (REACT)</h1>
                </div>
                <form className="input-container">
                    <input
                        type="text"
                        placeholder="What Needs To Be Done?"
                        onChange={(e) => setNewItem(e.target.value)}
                        value={newItem}
                    />
                    <button onClick={(e) => handleClick(e)}>Add</button>
                </form>
                <div className="list-container">
                    {list.map((item, index) => (
                        <div key={index} className="list-item-container">
                            <p className="item-name">{item}</p>
                            <button
                                className="item-delete-btn"
                                onClick={() => handleDelete(index)}
                            >
                                X
                            </button>
                        </div>
                    ))}
                </div>
            </section>
        </>
    );
}
