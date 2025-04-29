<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\TicketTypeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StudentController extends Controller
{
    public function ahmad(){
        return view('students.ahmad');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function appointment()
    {
        return view('appointment');
    }

    public function ticket()
    {
        return view('ticket');
    }
    
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xls,xlsx|max:2048',
        ]);

        // Get the uploaded file
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        
        // Process based on file type
        if ($extension == 'csv' || $extension == 'txt') {
            // Process CSV file
            return $this->processCSV($file);
        } else {
            // Process Excel file
            return $this->processExcel($file);
        }
    }
    
    /**
     * Process CSV file content
     */
    private function processCSV($file)
    {
        // Open the file
        $handle = fopen($file->getPathname(), 'r');
        
        // Skip the header row
        $header = fgetcsv($handle);
        
        // Initialize counters
        $imported = 0;
        $skipped = 0;
        $errors = [];
        
        // Process each row in the CSV file
        while (($row = fgetcsv($handle)) !== false) {
            // Map columns from the CSV to student fields
            // Assuming the CSV has columns in this order: Fname, LName, email, phoneNumber, Program, gender
            $data = [
                'Fname' => $row[0] ?? '',
                'LName' => $row[1] ?? '',
                'email' => $row[2] ?? '',
                'phoneNumber' => $row[3] ?? '',
                'Program' => $row[4] ?? '',
                'gender' => isset($row[5]) ? ($row[5] == '1' ? 'male' : 'female') : 'male',
                'password' => Hash::make('password123'), // Default password
                'status' => 'active' // Default status
            ];
            
            try {
                // Validate required fields
                if (empty($data['Fname']) || empty($data['LName']) || empty($data['email']) || empty($data['phoneNumber'])) {
                    $skipped++;
                    $errors[] = "Row skipped - missing required field: " . implode(', ', $row);
                    continue;
                }
                
                // Check if a student with this email already exists
                if (Student::where('email', $data['email'])->exists()) {
                    $skipped++;
                    $errors[] = "Duplicate email: {$data['email']}";
                    continue;
                }
                
                // Check if a student with this phone number already exists
                if (Student::where('phoneNumber', $data['phoneNumber'])->exists()) {
                    $skipped++;
                    $errors[] = "Duplicate phone number: {$data['phoneNumber']}";
                    continue;
                }
                
                // Create the student record
                $student = Student::create($data);
                
                // Assign the student role
                $student->assignRole('student');
                
                $imported++;
            } catch (\Exception $e) {
                $skipped++;
                $errors[] = "Error importing row: " . $e->getMessage();
            }
        }
        
        // Close the file
        fclose($handle);
        
        // Return with success/error message
        if ($imported > 0) {
            return redirect()->route('supervisor.index')
                ->with('success', "Successfully imported {$imported} students. Skipped: {$skipped}");
        } else {
            return redirect()->route('supervisor.index')
                ->with('error', "No students were imported. Skipped: {$skipped}. Errors: " . implode(', ', array_slice($errors, 0, 5)));
        }
    }
    
    /**
     * Process Excel file content
     */
    private function processExcel($file)
    {

        
        // Create a temporary file to store the CSV content
        $tempFile = tempnam(sys_get_temp_dir(), 'import_');
        $csvFilePath = $tempFile . '.csv';
        
        // On Windows, we can use COM to convert Excel to CSV
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' && class_exists('COM')) {
            try {
                // Create Excel application object
                $excel = new \COM('Excel.Application');
                
                // Make it invisible
                $excel->Visible = false;
                
                // Open the Excel file
                $workbook = $excel->Workbooks->Open($file->getPathname());
                
                // Save as CSV
                $workbook->SaveAs($csvFilePath, 6); // 6 is the code for CSV format
                
                // Close and release objects
                $workbook->Close();
                $excel->Quit();
                
                // Free COM objects
                unset($workbook);
                unset($excel);
                
                // Process the CSV file
                $csvFile = new \Illuminate\Http\UploadedFile(
                    $csvFilePath,
                    'converted.csv',
                    'text/csv',
                    null,
                    true
                );
                
                $result = $this->processCSV($csvFile);
                
                // Clean up temporary files
                @unlink($tempFile);
                @unlink($csvFilePath);
                
                return $result;
            } catch (\Exception $e) {
                @unlink($tempFile);
                @unlink($csvFilePath);
                
                return redirect()->route('supervisor.index')
                    ->with('error', 'Failed to process Excel file: ' . $e->getMessage());
            }
        } else {

            return redirect()->route('supervisor.index')
                ->with('error', 'Excel processing requires Windows with COM enabled. Please use CSV format instead.');
        }
    }
    
    /**
     * Store a new student in the database
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fName' => 'required|min:3',
            'email' => 'email|unique:students',
            'mobileNumber' => 'required|unique:students,phoneNumber|min:10|max:13',
            'password' => 'required|min:6|confirmed'
        ]);
        
        $student = Student::create([
            'Fname' => $request->fName,
            'LName' => $request->lName,
            'phoneNumber' => $request->mobileNumber,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'program' => $request->Program
        ]);

        
        
        // Assign the student role
        $student->assignRole('student');
        
        return redirect()->route('supervisor.index')
            ->with('success', trans('site.supervisor.users.added_successfully'));
    }

    /**
     * Edit an existing student
     */
    public function edit($id, Request $request)
    {
        $student = Student::findOrFail($id);
        
        // Only take fields that are provided and remove null values
        $data = array_filter($request->only(['Fname', 'LName', 'email', 'phoneNumber', 'status', 'Program']), function ($value) {
            return $value !== null;
        });

        // Only update if there is any data provided
        if (!empty($data)) {
            $student->update($data);
        }

        return redirect()->route('supervisor.index')
            ->with('success', trans('site.supervisor.users.updated_successfully'));
    }
    
    /**
     * Delete a student
     */
    public function delete($id)
    {
        Student::destroy($id);
        
        return redirect()->route('supervisor.index')
            ->with('success', trans('site.supervisor.users.deleted_successfully'));
    }


    public function test(Request $request)
    {
        $this->validate($request, [
            'fName' => 'required|min:3',
            'email' => 'email|unique:students',
            'mobileNumber' => 'required|unique:students,phoneNumber|min:10|max:13',
            'password' => 'required|min:6|confirmed'
        ]);
        
        $student = Student::create([
            'Fname' => $request->fName,
            'LName' => $request->lName,
            'phoneNumber' => $request->mobileNumber,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status
        ]);

        
        
        // Assign the student role
        $student->assignRole('student');
        return response()->json([
            'status' => 200, 
            'data' => $student,
        ]);
    }

    /**
     * Generate and download a sample import template
     */
    public function sampleTemplate()
    {
        // Define the CSV header and sample data
        $headers = ['Fname', 'LName', 'email', 'phoneNumber', 'Program', 'gender'];
        // Create a temporary file
        $tempFile = tempnam(sys_get_temp_dir(), 'sample_');
        $csvFile = $tempFile . '.csv';
        
        // Write the CSV content
        $handle = fopen($csvFile, 'w');
        
        // Write the header
        fputcsv($handle, $headers);
        
        
        // Close the file
        fclose($handle);
        
        // Set response headers for download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="student_import_template.csv"',
        ];
        
        // Return the file as a download
        $response = response()->download($csvFile, 'student_import_template.csv', $headers);
        
        // Register a callback to delete the temporary file after sending the response
        $response->deleteFileAfterSend(true);
        
        return $response;
    }
}
