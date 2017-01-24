  <style>
  button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 10px;
    width: 100%;
    border:1px solid gray;
    border-radius: 5px;
    text-align: left;
    outline: none;
    font-size: 12px;
    transition: 2.8s;
  }

  button.accordion.active, button.accordion:hover {
    background-color: #ddd;
  }

  div.accordion_panel {
    padding: 0 2px;
    display: none;
    background-color: white;
  }

  div.accordion_panel.show {
    display: block;
  }
  </style>
