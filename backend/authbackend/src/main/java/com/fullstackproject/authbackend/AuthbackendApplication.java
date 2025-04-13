package com.fullstackproject.authbackend;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.jpa.repository.config.EnableJpaRepositories;
import org.springframework.boot.autoconfigure.domain.EntityScan;

@SpringBootApplication(scanBasePackages = "com.fullstackproject")
@EnableJpaRepositories("com.fullstackproject.repository")
@EntityScan("com.fullstackproject.model")
public class AuthbackendApplication {

	public static void main(String[] args) {
		SpringApplication.run(AuthbackendApplication.class, args);
	}
}
