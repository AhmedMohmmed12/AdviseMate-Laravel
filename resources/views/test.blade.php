<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Ticket Type</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .close {
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            color: #555;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h2>Select Ticket Type</h2>
    <select id="ticket-type" class="form-control select2">
        <option value="">Select Ticket Type</option>
    </select>

    <!-- Modal -->
    <div id="ticket-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 id="modal-title"></h3>
            <form>
                <div class="form-group">
                    <label for="ticket-name">Ticket Type:</label>
                    <input type="text" id="ticket-name" name="ticket-name" readonly>
                </div>
                
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                
                <div class="form-group" id="extra-field" style="display: none;">
                    <label for="extra-input">Attach PDF:</label>
                    <input type="file" id="extra-input" name="extra-input" accept="application/pdf">
                </div>
                
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#ticket-type').select2({
                ajax: {
                    url: '/student/get-ticket-types',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data.map(function (ticket) {
                                return { id: ticket.id, text: ticket.ticket_type };
                            })
                        };
                    }
                }
            });

            $('#ticket-type').on('change', function () {
                var selectedId = parseInt($(this).val());
                var selectedText = $("#ticket-type option:selected").text();
                
                if (selectedText !== "Select Ticket Type") {
                    $('#modal-title').text(selectedText);
                    $('#ticket-name').val(selectedText);
                    
                    if (selectedId >= 4 && selectedId <= 7) {
                        $('#extra-field').show();
                    } else {
                        $('#extra-field').hide();
                    }
                    
                    $('#ticket-modal').fadeIn();
                }
            });

            $('.close').on('click', function () {
                $('#ticket-modal').fadeOut();
                $('#ticket-type').val(null).trigger('change');
            });

            $(window).on('beforeunload', function () {
                $('#ticket-modal').hide();
            });
        });
    </script>

</body>
</html>
