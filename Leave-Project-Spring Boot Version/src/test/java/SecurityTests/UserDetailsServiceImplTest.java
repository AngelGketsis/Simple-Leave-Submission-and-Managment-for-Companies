package SecurityTests;

import org.tardis.model.User;
import org.tardis.repository.UserRepository;
import org.tardis.security.UserDetailsServiceImpl;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.mockito.InjectMocks;
import org.mockito.Mock;
import org.mockito.MockitoAnnotations;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UsernameNotFoundException;

import static org.assertj.core.api.Assertions.assertThat;
import static org.assertj.core.api.Assertions.assertThatThrownBy;
import static org.mockito.Mockito.when;

public class UserDetailsServiceImplTest {

    @Mock
    private UserRepository userRepository;

    @InjectMocks
    private UserDetailsServiceImpl userDetailsService;

    @BeforeEach
    public void setUp() {
        MockitoAnnotations.openMocks(this);
    }

    @Test
    public void testLoadUserByUsername_UserExists() {
        // Arrange
        User user = new User();
        user.setUsername("admin");
        user.setPassword("$2a$10$DOWSD43Tp29T1j.Z0.Sd5e0A4nFs.fh48FH4d0OJhd/it0GxfBGSy");
        user.setRole("ROLE_ADMIN");
        when(userRepository.findByUsername("admin")).thenReturn(user);

        // Act
        UserDetails userDetails = userDetailsService.loadUserByUsername("admin");

        // Assert
        assertThat(userDetails).isNotNull();
        assertThat(userDetails.getUsername()).isEqualTo("admin");
        assertThat(userDetails.getPassword()).isEqualTo("$2a$10$DOWSD43Tp29T1j.Z0.Sd5e0A4nFs.fh48FH4d0OJhd/it0GxfBGSy");
        assertThat(userDetails.getAuthorities()).hasSize(1);
        assertThat(userDetails.getAuthorities().iterator().next().getAuthority()).isEqualTo("ROLE_ADMIN");
    }

    @Test
    public void testLoadUserByUsername_UserDoesNotExist() {
        // Arrange
        when(userRepository.findByUsername("admin")).thenReturn(null);

        // Act & Assert
        assertThatThrownBy(() -> userDetailsService.loadUserByUsername("admin"))
                .isInstanceOf(UsernameNotFoundException.class)
                .hasMessage("User not found");
    }
}