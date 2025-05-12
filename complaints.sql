-- Create Complaints Table
CREATE TABLE complaints (
    complaint_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,                    
    complaint_type ENUM('traveler', 'host') NOT NULL,  
    target_id INT NOT NULL,                  
    stay_id INT NOT NULL,                    
    subject VARCHAR(255) NOT NULL,           
    description TEXT NOT NULL,                  
    img VARCHAR(255),                    
    status ENUM('pending', 'in_review', 'resolved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (target_id) REFERENCES users(id),
    FOREIGN KEY (stay_id) REFERENCES stays(stay_id)
);

-- Create Traveler Stay History Table
CREATE TABLE traveler_stay_history (
    history_id INT PRIMARY KEY AUTO_INCREMENT,
    traveler_id INT NOT NULL,                -- ID of the traveler
    host_id INT NOT NULL,                    -- ID of the host they stayed with
    stay_id INT NOT NULL,                    -- ID of the specific stay
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    status ENUM('upcoming', 'ongoing', 'completed', 'cancelled') NOT NULL,
    rating INT,                              -- Rating given by the host (1-5)
    review TEXT,                             -- Review given by the host
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (traveler_id) REFERENCES users(id),
    FOREIGN KEY (host_id) REFERENCES users(id),
    FOREIGN KEY (stay_id) REFERENCES stays(stay_id)
);

-- Create Host Stay History Table
CREATE TABLE host_stay_history (
    history_id INT PRIMARY KEY AUTO_INCREMENT,
    host_id INT NOT NULL,                    -- ID of the host
    traveler_id INT NOT NULL,                -- ID of the traveler who stayed
    stay_id INT NOT NULL,                    -- ID of the specific stay
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    status ENUM('upcoming', 'ongoing', 'completed', 'cancelled') NOT NULL,
    rating INT,                              -- Rating given by the traveler (1-5)
    review TEXT,                             -- Review given by the traveler
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (host_id) REFERENCES users(id),
    FOREIGN KEY (traveler_id) REFERENCES users(id),
    FOREIGN KEY (stay_id) REFERENCES stays(stay_id)
);



