<?php 


// CREATE TABLE
// `Survey` (
//     `ID` int(255) NOT NULL AUTO_INCREMENT,
//     `LastName` varchar(255) DEFAULT NULL,
//     `FirstName` varchar(255) DEFAULT NULL,
//     `MiddleInitial` varchar(10) DEFAULT NULL,
//     `BirthPLace` varchar(255) DEFAULT NULL,
//     `BirthDate` date DEFAULT NULL,
//     `Age` int(11) DEFAULT NULL,
//     `Gender` varchar(10) DEFAULT NULL,
//     `CivilStatus` varchar(20) DEFAULT NULL,
//     `Religion` varchar(100) DEFAULT NULL,
//     `Dialect` varchar(100) DEFAULT NULL,
//     `Education` varchar(255) DEFAULT NULL,
//     `Job` varchar(255) DEFAULT NULL,
//     `MonthLyIncome` varchar(255) DEFAULT NULL,
//     `PhoneNumber` varchar(255) NOT NULL,
//     `Email` varchar(255) DEFAULT NULL,
//     `Remarks` text DEFAULT NULL,
//     `year_added` int(11) DEFAULT NULL,
//     PRIMARY KEY (`ID`)
//     /*T![clustered_index] CLUSTERED */
// ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin AUTO_INCREMENT = 30001
// make a class for the Survey model and use the $conn for the connection

$db = new MysqliDb ($conn);
// using the $db that used the MysqliDb class make a Survey model that uses the Survey Table to get data
class Survey extends MysqliDb {
    protected $tableName = 'Survey';

    public function __construct($conn) {
        parent::__construct($conn);
    }

    public function getSurveyById($id) {
        $this->where('ID', $id);
        return $this->getOne($this->tableName);
    }

    public function getAllSurveys($limit) {
        return $this->get($this->tableName, $limit);
    }

//    function that will panginate the results for 20 data per page 
/**
     * Get paginated surveys.
     *
     * @param int $page The page number.
     * @param int $resultsPerPage The number of results per page. Default is 20.
     * @return array The paginated survey results.
     */
    public function getPaginatedSurveys($limit, $offset, $searchTerm) {
        if (!empty($searchTerm)) {
            // Assuming you want to search in the FirstName and LastName columns.
            // You can add more columns to the search condition as needed.
            $this->where('FirstName', '%' . $searchTerm . '%', 'LIKE');
            $this->orWhere('LastName', '%' . $searchTerm . '%', 'LIKE');
        }
        
        // Enable pagination with totalCount for the pagination calculation
        $this->withTotalCount();
        
        // Get the results from the database
        $results = $this->get($this->tableName, [$offset, $limit]);
        
        // Return the results and the total count for pagination
        return [
            'results' => $results,
            'totalCount' => $this->totalCount
        ];
    }
    public function getTotalSurveys() {
        return $this->getValue($this->tableName, "count(ID)");
    }
    public function getAllSurvey(){
        $results = $this->get($this->tableName);
        
        $data = [
            
            'data' => $results
            
        ];
        return $data;
    }
    public function cacheSurveys() {
        $surveys = $this->getAllSurvey();
        $jsonData = json_encode($surveys);
        file_put_contents('../cache/surveys.json', $jsonData);
    }

    // Method to add a survey and update the cache
    public function addSurvey($data) {
        $result = $this->insert($this->tableName, $data);
        if ($result) {
            $this->cacheSurveys();
        }
        return $result;
    }

    // Method to update a survey and update the cache
    public function updateSurvey($id, $data) {
        $this->where('ID', $id);
        $result = $this->update($this->tableName, $data);
        if ($result) {
            $this->cacheSurveys();
        }
        return $result;
    }
    public function deleteSurvey($id) {
        $this->where('ID', $id);
        $result = $this->delete($this->tableName);
        if ($result) {
            $this->cacheSurveys();
        }
        return $result;
    }

    // count total numbers of Surveys using thier id 
    public function countSurveys() {
        return $this->getValue($this->tableName, "count(ID)");
    }
    public function getTotalMales() {
        $this->where('Gender', 'Male');
        return $this->getValue($this->tableName, 'count(ID)');
    }

    public function getTotalFemales() {
        $this->where('Gender', 'Female');
        return $this->getValue($this->tableName, 'count(ID)');
    }

    public function getTotalSeniors() {
        $this->where('Age', 60, '>=');
        return $this->getValue($this->tableName, 'count(ID)');
    }
    public function getEducationLevels() {
        $this->groupBy('Education');
        $this->orderBy('Education', 'asc');
        return $this->get($this->tableName, null, 'Education, COUNT(ID) as Count');
    }

    public function getMonthlyIncomeRanges() {
        // Assuming MonthLyIncome is a string like '<$1000', '$1000-$2000', '>$2000'
        $this->groupBy('MonthLyIncome');
        $this->orderBy('MonthLyIncome', 'asc');
        return $this->get($this->tableName, null, 'MonthLyIncome, COUNT(ID) as Count');
    }

    public function getJobCategories() {
        $this->groupBy('Job');
        $this->orderBy('Job', 'asc');
        return $this->get($this->tableName, null, 'Job, COUNT(ID) as Count');
    }

    public function getReligionDistribution() {
        $this->groupBy('Religion');
        $this->orderBy('Religion', 'asc');
        return $this->get($this->tableName, null, 'Religion, COUNT(ID) as Count');
    }

    public function getBirthplaceDistribution() {
        $this->groupBy('BirthPLace');
        $this->orderBy('BirthPLace', 'asc');
        return $this->get($this->tableName, null, 'BirthPLace, COUNT(ID) as Count');
    }

//SELECT year_added, COUNT(ID) as response_count FROM surveys GROUP BY year_added ORDER BY year_added ASC
    public function getYearAddedDistribution() {
        $this->groupBy('year_added');
        $this->orderBy('year_added', 'asc');
        return $this->get($this->tableName, null, 'year_added, COUNT(ID) as response_count');
    }

    public function getPhoneNumberAreaCodeDistribution() {
        // Assuming PhoneNumber format includes area code like '(123) 456-7890'
        $this->groupBy('LEFT(PhoneNumber, 5)'); // Adjust according to your format
        $this->orderBy('LEFT(PhoneNumber, 5)', 'asc');
        return $this->get($this->tableName, null, 'LEFT(PhoneNumber, 5) as AreaCode, COUNT(ID) as Count');
    }

    public function getDialectDistribution() {
        $this->groupBy('Dialect');
        $this->orderBy('Dialect', 'asc');
        return $this->get($this->tableName, null, 'Dialect, COUNT(ID) as Count');
    }
// getCivilStatusCounts()
    public function getCivilStatusCounts() {
        // $this->groupBy('CivilStatus');
        // $this->orderBy('CivilStatus', 'asc');
        return $this->rawQuery('SELECT CivilStatus, COUNT(ID) AS count FROM Survey GROUP BY CivilStatus');
    }

    // get all different kinds of jobs with distinct
    public function getJobTypes() {
        $this->groupBy('Job');
        $this->orderBy('Job', 'asc');
        return $this->get($this->tableName, null, 'Job');
    }
    

    // SELECT year_added, COUNT(*) as response_count FROM surveys GROUP BY year_added ORDER BY year_added ASC
    
}










?>