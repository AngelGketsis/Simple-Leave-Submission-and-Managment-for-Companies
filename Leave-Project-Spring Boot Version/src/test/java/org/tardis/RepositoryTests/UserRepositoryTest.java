package org.tardis.RepositoryTests;

import org.tardis.repository.*;

import org.tardis.model.User;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.jdbc.AutoConfigureTestDatabase;
import org.springframework.boot.test.autoconfigure.orm.jpa.DataJpaTest;
import org.springframework.test.context.ActiveProfiles;

import static org.assertj.core.api.Assertions.assertThat;

@DataJpaTest
@AutoConfigureTestDatabase(replace = AutoConfigureTestDatabase.Replace.NONE)
@ActiveProfiles("test")
public class UserRepositoryTest {

    @Autowired
    private UserRepository userRepository;

    @BeforeEach
    public void setUp() {
        User user = new User();
        user.setUsername("admin");
        user.setPassword("$2a$10$DOWSD43Tp29T1j.Z0.Sd5e0A4nFs.fh48FH4d0OJhd/it0GxfBGSy"); // Example BCrypt hashed password
        user.setRole("ROLE_ADMIN");
        userRepository.save(user);
    }

    @Test
    public void testFindByUsername() {
        // Act
        User foundUser = userRepository.findByUsername("admin");

        // Assert
        assertThat(foundUser).isNotNull();
        assertThat(foundUser.getUsername()).isEqualTo("admin");
        assertThat(foundUser.getPassword()).isEqualTo("$2a$10$DOWSD43Tp29T1j.Z0.Sd5e0A4nFs.fh48FH4d0OJhd/it0GxfBGSy");
        assertThat(foundUser.getRole()).isEqualTo("ROLE_ADMIN");
    }
}